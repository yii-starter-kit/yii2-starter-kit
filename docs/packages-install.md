#edit host file if needed, add yii2-starter-kit.dev
docker exec -it yii2packages_app_1 bas
apt-get update -y
apt-get install git npm wget -y
wget https://getcomposer.org/composer.phar -O composer.phar
php composer.phar global require "fxp/composer-asset-plugin" -o -vvv
php composer.phar install --ansi --profile --prefer-source -o -vvv
php console/yii app/setup
npm install
npm run build

Packages:
    "davidjeddy/yii2-freeradius-module": "dev-master@dev",
    "davidjeddy/yii2-poll": "dev-master@dev",
    "davidjeddy/yii2-rss-reader": "dev-master@dev",
    "davidjeddy/yii2-stripe": "dev-master@dev""