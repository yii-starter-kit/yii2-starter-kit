#!/usr/bin/env bash
packages=$(echo "$1")
folder=$([ -z "$2" ] && echo '/var/www' || echo "$2")

echo "Etc/UTC" > /etc/timezone
dpkg-reconfigure -f noninteractive tzdata

echo "mysql-server-5.6 mysql-server/root_password password root" | debconf-set-selections
echo "mysql-server-5.6 mysql-server/root_password_again password root" | debconf-set-selections

sudo apt-get update
sudo apt-get upgrade -y
sudo apt-get install -y ${packages}

if [ ! -d /etc/nginx/sites-enabled/yii2-starter-kit.dev ]; then
    sudo ln -s /var/www/nginx.conf /etc/nginx/sites-enabled/yii2-starter-kit.dev
fi

if [ ! -d /var/www/vendor ]; then
    cd /var/www && sudo composer install
    php /var/www/init --env=dev --overwrite=n
else
    cd /var/www/vendor
    sudo composer update --prefer-dist
fi

echo "CREATE DATABASE IF NOT EXISTS \`yii2-starter-kit\` CHARACTER SET utf8 COLLATE utf8_unicode_ci" | mysql -uroot -proot

php /var/www/console/yii migrate up --interactive=0
php /var/www/console/yii rbac/init

sed -i 's/bind-address    = 127.0.0.1/bind-address    = 0.0.0.0/g' /etc/mysql/my.cnf;
sed -i 's/skip-external-locking/skip-external-locking skip-name-resolve/g' /etc/mysql/my.cnf;

sudo service mysql restart
sudo service php5-fpm restart
sudo service nginx restart