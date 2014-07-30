Yii 2 Starter Kit
================================


REQUIREMENTS
------------

The minimum requirement by this application template that your Web server supports PHP 5.4.0.


INSTALLATION
------------

### Install from an Archive File

Extract the github archive file to a directory named `yii2-starter-kit` that is directly under the Web root.

You can then access the application through the following URL:

~~~
http://localhost/yii2-starter-kit/web/
~~~


### Install via Composer

If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

You can then install this application template using the following command:

~~~
php composer.phar create-project --prefer-dist --stability=dev trntv/yii2-starter-kit
~~~

Now you should be able to access the application through the following URL, assuming `yii2-starter-kit` is the directory
directly under the Web root.

~~~
http://localhost/web/
~~~


CONFIGURATION
-------------

### Database

Edit the file `environments/local/config/db.php` with real data, for example:

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

#### Apply migrations

```php
php environments/local/yii migrate
```

### Initial RBAC config

```php
php environmetns/local/yii rbac/init
```
