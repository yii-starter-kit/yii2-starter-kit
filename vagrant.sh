#!/usr/bin/env bash
# Options
packages=$(echo "$1")
github_token=$(echo "$2")
swapsize=$(echo "$3")
# Helpers
composer="hhvm /usr/local/bin/composer"

# System configuration
if ! grep --quiet "swapfile" /etc/fstab; then
  fallocate -l ${swapsize}M /swapfile
  chmod 600 /swapfile
  mkswap /swapfile
  swapon /swapfile
  echo '/swapfile none swap defaults 0 0' >> /etc/fstab
fi

# Additional repositories
if [ ! -f /etc/apt/sources.list.d/hhvm.list ]; then
    sudo apt-key adv --recv-keys --keyserver hkp://keyserver.ubuntu.com:80 0x5a16e7281be7a449
    sudo echo 'deb http://dl.hhvm.com/ubuntu trusty main' >> /etc/apt/sources.list.d/hhvm.list
fi

# Configuring server software
sudo update-locale LC_ALL="C"
sudo dpkg-reconfigure locales
echo "mysql-server-5.6 mysql-server/root_password password root" | debconf-set-selections
echo "mysql-server-5.6 mysql-server/root_password_again password root" | debconf-set-selections

sudo apt-get update
sudo apt-get upgrade -y
sudo apt-get install -y ${packages}

sudo php5enmod mcrypt
sudo sed -i 's/bind-address.*/bind-address = 0.0.0.0/g' /etc/mysql/my.cnf;
if ! grep --quiet '^xdebug.remote_enable = on$' /etc/php5/mods-available/xdebug.ini; then
    (
     echo "xdebug.remote_enable = on";
     echo "xdebug.remote_connect_back = on";
     echo "xdebug.remote_host = 10.0.2.2";
     echo "xdebug.idekey = \"vagrant\""
    ) >> /etc/php5/mods-available/xdebug.ini
fi

# install composer
if [ ! -f /usr/local/bin/composer ]; then
	sudo curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
    ${composer} global require fxp/composer-asset-plugin --prefer-dist
else
	${composer} self-update
	${composer} global update --prefer-dist
fi
${composer} config --global github-oauth.github.com ${github_token}

# init application
if [ ! -d /var/www/vendor ]; then
    cd /var/www && ${composer} install --prefer-dist --optimize-autoloader
else
    cd /var/www && ${composer} update --prefer-dist --optimize-autoloader
fi

php /var/www/init --env=dev --overwrite=n

# create nginx config
if [ ! -f /etc/nginx/sites-enabled/yii2-starter-kit.dev ]; then
    sudo ln -s /var/www/nginx.conf /etc/nginx/sites-enabled/yii2-starter-kit.dev
fi

# Configuring application
echo "GRANT ALL PRIVILEGES ON *.* TO 'root'@'%' IDENTIFIED BY 'root'" | mysql -uroot -proot
echo "FLUSH PRIVILEGES'" | mysql -uroot -proot
echo "CREATE DATABASE IF NOT EXISTS \`yii2-starter-kit\` CHARACTER SET utf8 COLLATE utf8_unicode_ci" | mysql -uroot -proot

php /var/www/console/yii migrate up --interactive=0
php /var/www/console/yii rbac/init

sudo service mysql restart
sudo service php5-fpm restart
sudo service nginx restart