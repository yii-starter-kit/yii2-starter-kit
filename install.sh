#!/bin/sh

cp .env.dist .env && composer install && console/yii app/setup --interactive=0