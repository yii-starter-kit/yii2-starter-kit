# INSTALLATION

## TABLE OF CONTENTS
- [Requirements](#requirements)
- Regular installation
    - [Before you begin](#before-you-begin)
    - [Install via Composer](#install-via-composer)
    - [Setup application](#setup-application)
    - [Configure your web server](#configure-your-web-server)
    - [Vagrant](#vagrant)
    - [Demo users](#demo-user)
- [Single domain installtion](#single-domain-installation)

## REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 5.5.0.
Required PHP extensions:
- intl
- gd
- mcrypt

### Before you begin
If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Install composer-asset-plugin needed for yii assets management
```bash
composer global require "fxp/composer-asset-plugin"
```

### Install via Composer

You can install this application template with `composer` using the following command:

```
composer create-project --prefer-dist --stability=dev trntv/yii2-starter-kit
```

### Setup application
1. Copy `.env.dist` to `.env` in the project root
2. Adjust settings in `.env` file
	- Set debug mode and your current environment
	```
	YII_DEBUG   = true
	YII_ENV     = dev
	```
	- Set DB configuration
	```
	DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=yii2-starter-kit
	DB_USERNAME      = user
	DB_PASSWORD      = password
	```

	- Set application canonical urls
	```
	FRONTEND_URL    = http://yii2-starter-kit.dev
	BACKEND_URL     = http://backend.yii2-starter-kit.dev
	STORAGE_URL     = http://storage.yii2-starter-kit.dev
	```

3. Run
```
php console/yii app/setup
```

### Configure your web server
Copy `vhost.conf.dist` to `vhost.conf`, change it with your local settings and copy (symlink) it to nginx ``sites-enabled`` directory.
Or configure your web server with three different web roots:
- yii2-starter-kit.dev => /path/to/yii2-starter-kit/frontend/web
- backend.yii2-starter-kit.dev => /path/to/yii2-starter-kit/backend/web
- storage.yii2-starter-kit.dev => /path/to/yii2-starter-kit/storage/web


### Vagrant
If you want, you can use bundled Vagrant instead of installing app to your local machine.

1. Install [Vagrant](https://www.vagrantup.com/)
2. Copy `vagrant.dist.yaml` to `vagrant.yaml`
3. Create GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens) and paste in into `vagrant.yml`
4. Run:
```
vagrant plugin install vagrant-hostmanager
vagrant up
```
That`s all. After provision application will be accessible on http://yii2-starter-kit.dev

### Demo users
```
Login: webmaster
Password: webmaster

Login: manager
Password: manager

Login: user
Password: user
```

## Single domain installation
### Setup application
Adjust settings in `.env` file

```
FRONTEND_URL    = http://yii2-starter-kit.dev
BACKEND_URL     = http://yii2-starter-kit.dev/backend
STORAGE_URL     = http://yii2-starter-kit.dev/storage
```
	

### Configure your web server
#### Nginx
This is an example single domain config for nginx

```
# Based on https://github.com/mickgeek/yii2-advanced-one-domain-config

upstream php-fpm {
    server unix:/var/run/php5-fpm.sock;
}

server {
    listen       80; # listen for IPv4
    #listen       [::]:80 ipv6only=on; # listen for IPv6
    server_name  yii2-starter-kit.dev;
    root         /path/to/yii2-starter-kit;

    charset      utf-8;
    client_max_body_size  32M;

    # frontend access
    location / {
        root  /path/to/yii2-starter-kit/frontend/web;
        try_files  $uri /frontend/web/index.php?$args;
        
        # location ~* ^.+\.(jpg|jpeg|gif|png|ico|css|pdf|ppt|txt|bmp|rtf|js)$ {
	#	  access_log off;
	#	  expires max;
	# }
    }
    
    # backend access
    location /backend {
        alias  /path/to/yii2-starter-kit/backend/web;
        try_files  $uri /backend/web/index.php?$args;
    }
    
    # storage access
    location /storage {
        alias  /path/to/yii2-starter-kit/storage/web;
        try_files  $uri /storage/web/index.php?$args;

        location ~* ^/storage/(.+\.php)$ {
            try_files  $uri /storage/web/$1?$args;
        }

        # avoid processing of calls to non-existing static files by Yii (uncomment if necessary)
        #location ~* ^/storage/(.+\.(css|js|jpg|jpeg|png|gif|bmp|ico|mov|swf|pdf|zip|rar))$ {
        #    try_files  $uri /storage/web/$1?$args;
        #}
    }

    location ~ \.php$ {
  		fastcgi_split_path_info ^(.+\.php)(/.+)$;
  		fastcgi_pass php-fpm;
  		fastcgi_index index.php;
  		include fastcgi_params;
  
  		## Cache
  		# fastcgi_pass_header Cookie; # fill cookie valiables, $cookie_phpsessid for exmaple
  		# fastcgi_ignore_headers Cache-Control Expires Set-Cookie; # Use it with caution because it is cause SEO problems
  		# fastcgi_cache_key "$request_method|$server_addr:$server_port$request_uri|$cookie_phpsessid"; # generating unique key
  		# fastcgi_cache fastcgi_cache; # use fastcgi_cache keys_zone
  		# fastcgi_cache_path /tmp/nginx/ levels=1:2 keys_zone=fastcgi_cache:16m max_size=256m inactive=1d;
  		# fastcgi_temp_path  /tmp/nginx/temp 1 2; # temp files folder
  		# fastcgi_cache_use_stale updating error timeout invalid_header http_500; # show cached page if error (even if it is outdated)
  		# fastcgi_cache_valid 200 404 10s; # cache lifetime for 200 404;
  		# or fastcgi_cache_valid any 10s; # use it if you want to cache any responses
  	}

    # avoid processing of calls to non-existing static files by Yii for frontend, backend and storage (uncomment if necessary)
    #location ~* \.(css|js|jpg|jpeg|png|gif|bmp|ico|mov|swf|pdf|zip|rar)$ {
    #    access_log  off;
    #    log_not_found  off;
    #    try_files  $uri /frontend/web$uri =404;
    #}

    location ~* \.(htaccess|htpasswd|svn|git) {
        deny all;
    }
}
```
