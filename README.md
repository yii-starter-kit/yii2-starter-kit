# Yii 2 Starter Kit

<!-- BADGES/ -->

[![Packagist](https://img.shields.io/packagist/v/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![Packagist](https://img.shields.io/packagist/dt/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![PayPal donate button](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7UFA3F3ALPM8 "Donate once-off to this project using Paypal")
[![Dependency Status](https://www.versioneye.com/php/trntv:yii2-starter-kit/badge.svg)](https://www.versioneye.com/php/trntv:yii2-starter-kit)
[![Build Status](https://travis-ci.org/trntv/yii2-starter-kit.svg?branch=master)](https://travis-ci.org/trntv/yii2-starter-kit)

<!-- /BADGES -->

This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2. 

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

## Before you start
Please, consider helping project via [contributions](https://github.com/trntv/yii2-starter-kit/issues) or [donations](#donations). 

## TABLE OF CONTENTS
- [Demo](#demo)
- [Features](#features)
- [Installation](docs/installation.md)
    - [Manual installation](docs/installation.md#manual-installation)
    - [Docker installation](docs/installation.md#docker-installation)
    - [Vagrant installation](docs/installation.md#vagrant-installation)
- [Application components](#application-components)
- [Console commands](docs/console.md)
- [Testing](docs/testing.md)
- [FAQ](docs/faq.md)
- [How to contribute?](#how-to-contribute)
- [Donations](#donations)
- [Have any questions](#have-any-questions)

## DEMO
Demo is hosted by awesome [Digital Ocean](https://m.do.co/c/d7f000191ea8)

Frontend:
http://yii2-starter-kit.terentev.net

Backend:
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
## Donations for further development
- [Bitcoin] (https://www.coinbase.com/checkouts/2f1c1cb31c395e5aaafa1ba70003552e)
- [WebMoney] (Z110052695454)
- Other way: [eugene@terentev.net](mailto:eugene@terentev.net)

## FEATURES
- Beautiful and open source dashboard theme for backend [AdminLTE 2](http://almsaeedstudio.com/AdminLTE)
- Built-in translations:
    - English
    - Spanish
    - Russian
    - Ukrainian
    - Chinese
    - Vietnamese
    - Polish
    - Portuguese (Brazil)
- Translations Editor
- Language change action + behavior to choose locale based on browser preferred language 
- Sign in, Sign up, profile(avatar, locale, personal data), email activation etc
- OAuth authorization
- User management
- RBAC with predefined `guest`, `user`, `manager` and `administrator` roles
- RBAC migrations support
- Content management components: articles, categories, static pages, editable menu, editable carousels, text blocks
- [Webpack](https://webpack.js.org/) configuration
- Key-value storage component
- Application settings form (based on KeyStorage component)
- Ready-to-go RESTful API module
- [File storage component + file upload widget](https://github.com/trntv/yii2-file-kit)
- On-demand thumbnail creation [trntv/yii2-glide](https://github.com/trntv/yii2-glide)
- Command Bus with queued and async tasks support [trntv/yii2-command-bus](https://github.com/trntv/yii2-command-bus)
- Useful behaviors (GlobalAccessBehavior, CacheInvalidateBehavior, MaintenanceBehavior)
- Yii2 log web interface
- Application timeline component
- Cache web controller
- Maintenance mode component ([more](#maintenance-mode))
- System information web interface
- dotenv support
- `ExtendedMessageController` with ability to replace source code language and migrate messages between message sources
- [Aceeditor widget](https://github.com/trntv/yii2-aceeditor)
- [Datetimepicker widget](https://github.com/trntv/yii2-bootstrap-datetimepicker), 
- [Imperavi Reactor Widget](https://github.com/asofter/yii2-imperavi-redactor), 
- [Elfinder Extension](https://github.com/MihailDev/yii2-elfinder)
- [Xhprof Debug panel](https://github.com/trntv/yii2-debug-xhprof)
- Extended IDE autocompletion
- Nginx config example
- Test-ready
- Docker support and Vagrant support
- Built-in [mailcatcher](http://mailcatcher.me/)
- Assets compression and concatenation
- [Some useful shortcuts](https://github.com/trntv/yii2-starter-kit/blob/master/common/helpers.php)
- many other features i'm lazy to write about :-)


# Application Components

### I18N
If you want to store application messages in DB and to have ability to edit them from backend, run:
```
php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php
```
it will copy all existing messages to database

Then uncomment config for `DbMessageSource` in
```php
common/config/base.php
```

### KeyStorage
Key storage is a key-value storage to store different information. Application settings for example.
Values can be stored both via api or by backend CRUD component.
```
Yii::$app->keyStorage->set('articles-per-page', 20);
Yii::$app->keyStorage->get('articles-per-page'); // 20
```

### Maintenance mode
Starter kit has built-in component to provide a maintenance functionality. All you have to do is to configure ``maintenance``
component in your config
```php
'bootstrap' => ['maintenance'],
...
'components' => [
    ...
    'maintenance' => [
        'class' => 'common\components\maintenance\Maintenance',
        'enabled' => Astronomy::isAFullMoonToday()
    ]
    ...
]
```
This component will catch all incoming requests, set proper response HTTP headers (503, "Retry After") and show a maintenance message.
Additional configuration options can be found in a corresponding class.

Starter kit configured to turn on maintenance mode if ``frontend.maintenance`` key in KeyStorage is set to ``true``

### Command Bus
- [What is command bus?](http://shawnmc.cool/command-bus)

In Starter Kit Command Bus pattern is implemented with [tactician](https://github.com/thephpleague/tactician) package and 
it's yii2 connector - [yii2-tactician](https://github.com/trntv/yii2-tactician)

Command are stored in ``common/commands/command`` directory, handlers in ``common/commands/handler``

To execute command run
```php
$sendEmailCommand = new SendEmailCommand(['to' => 'user@example.org', 'body' => 'Hello User!']);
Yii::$app->commandBus->handle($sendEmailCommand);
```

### Timeline (Activity)
```php
$addToTimelineCommand = new AddToTimelineCommand([
    'category' => 'user', 
    'event' => 'signup', 
    'data' => ['foo' => 'bar']
]);
Yii::$app->commandBus->handle($addToTimelineCommand);
```

### Behaviors
#### CacheInvalidateBehavior
```php
 public function behaviors()
 {
     return [
         [
             'class' => `common\behaviors\CacheInvalidateBehavior`,
             'tags' => [
                  'awesomeTag',
                   function($model){
                       return "tag-{$model->id}"
                  }
              ],
             'keys' => [
                  'awesomeKey',
                  function($model){
                      return "key-{$model->id}"
                  }
              ]
         ],
     ];
 }
```
#### GlobalAccessBehavior
Add in your application config:
```php
'as globalAccess'=>[
        'class'=>'\common\behaviors\GlobalAccessBehavior',
        'rules'=>[
            [
                'controllers'=>['sign-in'],
                'allow' => true,
                'roles' => ['?'],
                'actions'=>['login']
            ],
            [
                'controllers'=>['sign-in'],
                'allow' => true,
                'roles' => ['@'],
                'actions'=>['logout']
            ],
            [
                'controllers'=>['site'],
                'allow' => true,
                'roles' => ['?', '@'],
                'actions'=>['error']
            ],
            [
				'allow' => true,
				'roles' => ['@']
			]
        ]
    ]
```
It will allow access to you application only for authentificated users. 

### Command Bus
Read more about command bus on in [official repository](https://github.com/trntv/yii2-command-bus#yii2-command-bus)

### Widgets configurable from backend
#### Carousel
1. Create carousel in backend
2. Use it:
```php
<?php echo DbCarousel::widget(['key' => 'key-from-backend']) ?>
```

#### DbText
1. Create text block in backend
2. Use it:
```php
<?php echo DbText::widget(['key' => 'key-from-backend']) ?>
```

#### DbMenu
1. Create text block in backend
2. Use it:
```php
<?php echo DbMenu::widget(['key' => 'key-from-backend']) ?>
```

### Widgets
- [WYSIWYG Redactor widget](https://github.com/asofter/yii2-imperavi-redactor)  
- [DateTime picker](https://github.com/trntv/yii2-bootstrap-datetimepicker)
- [Ace Editor](https://github.com/trntv/yii2-aceeditor)
- [File upload](https://github.com/trntv/yii2-file-kit)
- [ElFinder](https://github.com/MihailDev/yii2-elfinder)


### Grid
#### EnumColumn
```php
 [
      'class' => '\common\grid\EnumColumn',
      'attribute' => 'status',
      'enum' => User::getStatuses() // [0=>'Deleted', 1=>'Active']
 ]
```
### API
Starter Kit has fully configured and ready-to-go REST API module. You can access it on http://yii2-starter-kit.dev/api/v1
For some endpoints you should authenticate your requests with one of available methods - https://github.com/yiisoft/yii2/blob/master/docs/guide/rest-authentication.md#authentication

### MultiModel
``common\base\MultiModel`` - class for handling multiple models in one
In controller:
```php
$model = new MultiModel([
    'models' => [
        'user' => $userModel,
        'profile' => $userProfileModel
    ]
]);

if ($model->load(Yii::$app->request->post()) && $model->save()) {
    ...
}
```
In view:
```php
<?php echo $form->field($model->getModel('account'), 'username') ?>

<?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255]) ?>    
```
### Other
- ``common\behaviors\GlobalAccessBehavior`` - allows to set access rules for your application in application config

- ``common\behaviors\LocaleBehavior`` - discover user locale from browser or account settings and set it

- ``common\behaviors\LoginTimestampBehavior`` - logs user login time

- ``common\validators\JsonValidator`` - validates a value to be a valid json

- ``common\rbac\rule\OwnModelRule`` - simple rule for RBAC to check if the current user is model owner
```php
Yii::$app->user->can('editOwnModel', ['model' => $model]);
```

- ``common\filters\OwnModelAccessFilter`` - action filter to check if user is allowed to manage this model
```php
public function behaviors()
    {
        return [
            'modelAccess' => [
                'class' => OwnModelAccessFilter::className(),
                'only' => ['view', 'update', 'delete'],
                'modelCreatedByAttribute' => 'created_by',
                'modelClass' => Article::className()
            ],
        ];
    }
```

## How to contribute?
You can contribute in any way you want. Any help appreciated, but most of all i need help with docs (^_^)

## Have any questions?
mail to [eugene@terentev.net](mailto:eugene@terentev.net)

## READ MORE
https://github.com/yiisoft/yii2/blob/master/apps/advanced/README.md
https://github.com/yiisoft/yii2/tree/master/docs

### NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can begin your application, rather than creating it from scratch.
Good luck!

