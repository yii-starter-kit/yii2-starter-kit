# INSTALLATION

## TABLE OF CONTENTS
- [Before you begin](#before-you-begin)
- [Manual installation](#manual-installation)
    - [Requirements](#requirements)
    - [Setup application](#setup-application)
    - [Configure your web server](#configure-your-web-server)

- [Docker installation](#docker-installation)
- [Single domain installtion](#single-domain-installation)
- [Default accounts](#default-accounts)

## Before you begin
1. If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
   at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).
2. Install [NPM](https://docs.npmjs.com/getting-started/installing-node) to build frontend code
3. Install [taskctl](https://github.com/taskctl/taskctl) to run tasks

## Get source code
### Option 1: Get source code via Composer
You can install this application template with `composer` using the following command:

```
composer create-project yii2-starter-kit/yii2-starter-kit myproject.com
```

### Option 2: Download sources
https://github.com/yii2-starter-kit/yii2-starter-kit/archive/main.zip

#### Or clone repository manually
```
git clone https://github.com/yii2-starter-kit/yii2-starter-kit.git
```

## Install dependencies
```
taskctl install
```
or
```
composer install
npm ci
```

## Docker installation
1. Install [Docker](https://docs.docker.com/get-docker/) (Compose v2 is included) and [composer](https://getcomposer.org/) to your system
2. Run ``taskctl start`` or ``composer run-script docker:build``
3. That's all - your application is accessible on [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost)

*PS* Also you can use bash inside application container. To do so run `docker compose exec console bash`

### Docker FAQ
1. How do I run yii console commands from outside a container?

``docker compose exec console php console/yii help``

``docker compose exec console php console/yii migrate``

``docker compose exec console php console/yii rbac-migrate``

2. How to connect to the application database with my workbench, navicat etc?
MySQL is available on `yii2-starter-kit.localhost`, port `3306`. User - `root`, password - `root`

## Manual installation

### REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 8.4.
Required PHP extensions:
- intl
- gd
- pdo_mysql
- fileinfo
- zip

### Setup application
1. Run ``taskctl install``
1. Run ``taskctl build:env``
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
	API_HOST_INFO         = http://api.yii2-starter-kit.localhost
	FRONTEND_HOST_INFO    = http://yii2-starter-kit.localhost
	BACKEND_HOST_INFO     = http://backend.yii2-starter-kit.localhost
	STORAGE_HOST_INFO     = http://storage.yii2-starter-kit.localhost
	```

3. Run
```taskctl local:build```
or
```
php console/yii app/setup
npm run build
```

### Configure your web server
- Copy `docker/nginx/vhost.conf` to your nginx config directory
- Change it to fit your environment

## Demo data

### Add random articles data

You can insert random article data by running the following command:

```
console/yii app/demo-data N
```

Where `N` is the number of categories and articles to be added to the database. Defaults to `30`.

In docker, please run:

```
docker compose exec console php console/yii app/demo-data
```

### Default accounts
```
Login: webmaster
Password: webmaster

Login: manager
Password: manager

Login: user
Password: user
```

## Single domain installation
1. Setup application
Adjust settings in `.env` file

```
FRONTEND_BASE_URL   = /
BACKEND_BASE_URL    = /backend/web
STORAGE_BASE_URL    = /storage/web
```

2. Adjust settings in `backend/config/web.php` file
```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '/admin',
        ...
```
3. Adjust settings in `frontend/config/web.php` file
```
    ...
    'components'=>[
        ...
        'request' => [
            'baseUrl' => '',
        ...
```

4. Configure your web server
Example of single domain config for nginx can be found [here](https://github.com/yii2-starter-kit/yii2-starter-kit/blob/main/docker/nginx/vhost_single_domain.conf)
