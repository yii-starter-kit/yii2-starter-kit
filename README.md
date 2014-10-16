Yii 2 Starter Kit
================================

FEATURES
--------
- Based on yii2-advanced application template
- Beautiful and free dashboard theme for backend - http://almsaeedstudio.com/AdminLTE
- I18N + 2 translations: Ukrainian, Russian
- I18N DbMessageSource CRUD module + `MessageMigrateController` to migrate translations between formats
- Sign in, Sign up, profile(avatar, locale, personal data) etc
- OAuth authorization
- User management: CRUD
- RBAC with predefined `guest`, `user`, `manager` and `administrator` roles
- Content management: articles, categories, static pages, editable menu, editable carousels, text blocks
- File storage component + custom upload widget (https://github.com/trntv/yii2-file-kit)
- Key value storage component
- System log
- System events log
- System information
- aceeditor, imperavi, elfinder
- nginx example config
- example deploy script

DEMO
----

http://yii2-starter-kit.terentev.net

http://backend.yii2-starter-kit.terentev.net

`administrator` role account
```
Login: webmaster
Password: webmaster
```

`manager` role account
```
Login: manager
Password: manager
```

`user` role account
```
Login: user
Password: user
```

REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Before installation
Install composer-asset-plugin needed for yii assets management
```
php composer.phar global require "fxp/composer-asset-plugin:1.0.0-beta3"
```

### Install from an Archive File

Extract the github archive file to a directory named `yii2-starter-kit` that is directly under the Web root.

After extraction run
```
php composer.phar install
```

### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer.phar create-project --prefer-dist --stability=dev trntv/yii2-starter-kit
~~~

CONFIGURATION
-------------

### Database

Edit the file `environments/local/common/config/_db.php` with real data, for example:

```php
return [
    'class' => 'yii\db\Connection',
    'dsn' => 'mysql:host=localhost;dbname=yii2-starter-kit',
    'username' => 'root',
    'password' => '1234',
    'charset' => 'utf8',
];
```
**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.

Also check and edit the other files in the `config/` directory to customize your application.

### Application urls
Edit the file `environments/local/bootstrap.php`
```php
Yii::setAlias('@frontendUrl', 'http://example.com');
Yii::setAlias('@backendUrl', 'http://backend.example.com');
Yii::setAlias('@storageUrl', 'http://storage.example.com');
```
#### Apply migrations

```php
php environments/local/console/yii migrate
```

### Initial RBAC config

```php
php environments/local/console/yii rbac/init
```
**IMPORTANT: without rbac/init you CAN'T LOG IN into backend**
### Demo user
~~~
Login: webmaster
Password: webmaster
~~~

### I18N
If you want to store application messages in DB and to have ability to edit them from backend, run:
```php
php environments/local/console/yii message-migrate @common/config/messages/php.php @common/config/messages/db.php
```
it will copy all existing messages to database

Then uncomment config for `DbMessageSource` in
```php
common/config/_base.php
```

### TODO
- Chained selects extension
- jGrowl widget
- DbMessageSource management module
- Upload Kit improvements
- Inline code documentation
- Tests
- Various improvements
- Permanent bug fixing ;)

### Have any questions?
mail to `eugine@terentev.net`