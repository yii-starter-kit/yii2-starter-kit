# INSTALLATION

## TABLE OF CONTENTS
- [INSTALLATION](#installation)
	- [TABLE OF CONTENTS](#table-of-contents)
	- [Before you begin](#before-you-begin)
	- [Get source code](#get-source-code)
		- [Option 1: Get source code via Composer](#option-1-get-source-code-via-composer)
		- [Option 2: Download sources](#option-2-download-sources)
			- [Or clone repository manually](#or-clone-repository-manually)
	- [Install dependencies](#install-dependencies)
	- [Docker installation](#docker-installation)
	- [Manual installation](#manual-installation)
		- [REQUIREMENTS](#requirements)
		- [Setup application](#setup-application)
		- [Configure your web server](#configure-your-web-server)
	- [Demo data](#demo-data)
	- [Add Random Articles Data](#add-random-articles-data)
		- [Demo Users](#demo-users)
	- [Single domain installation](#single-domain-installation)
	- [Important notes](#important-notes)

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
https://github.com/yii2-starter-kit/yii2-starter-kit/archive/master.zip

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
npm install
```

## Docker installation

The recommended way to run the project is with Docker. All you need is Docker and `docker compose` — no local PHP or Node required.

See the full guide: **[docs/docker.md](docker.md)**

Quick start:
```bash
cp .env.dist .env
./console/ysk up --build
./console/ysk install
./console/ysk setup
```

## Manual installation

### REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 7.
Required PHP extensions:
- intl
- gd
- com_dotnet (for Windows)

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
	FRONTEND_HOST_INFO    = http://yii2-starter-kit.localhost
	BACKEND_HOST_INFO     = http://backend.yii2-starter-kit.localhost
	STORAGE_HOST_INFP     = http://storage.yii2-starter-kit.localhost
	```

3. Run
```taskctl local:build```
or
```
php console/yii app/setup
npm run build
```

### Configure your web server
- Copy `docker/vhost.conf` to your nginx config directory
- Change it to fit your environment

## Demo data

## Add Random Articles Data

You can insert random article data by running the following command:

```
console/yii app/demo-data N
```

Where `N` is the number of categories and articles to be added to the database. Defaults to `30`.

In docker, please run:

```
docker-compose exec app console/yii app/demo-data
```

### Demo Users
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
Example of single domain config for nginx can be found [here](https://github.com/yii2-starter-kit/yii2-starter-kit/blob/master/docker/nginx/vhost_single_domain.conf)

## Important notes
- There is a VirtualBox bug related to sendfile that can lead to corrupted files, if not turned-off
Uncomment this in your nginx config if you are using Vagrant:
```sendfile off;```
