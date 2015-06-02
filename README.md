# Yii 2 Starter Kit

<!-- BADGES/ -->

[![Packagist](https://img.shields.io/packagist/v/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![Packagist](https://img.shields.io/packagist/dt/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![PayPal donate button](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7UFA3F3ALPM8 "Donate once-off to this project using Paypal")
[![Dependency Status](https://www.versioneye.com/php/trntv:yii2-starter-kit/badge.svg)](https://www.versioneye.com/php/trntv:yii2-starter-kit)

<!-- /BADGES -->

This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2. 

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

## TABLE OF CONTENTS
- [Demo](#demo)
- [Features](#features)
- [Installation](https://github.com/trntv/yii2-starter-kit/blob/master/docs/installation.md)
- [Application components](#application-components)
- [Updates](#updates)
- [How to contribute?](#how-to-contribute)
- [Have any questions](#have-any-questions)

##DEMO
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

## FEATURES
- Beautiful and open source dashboard theme for backend [AdminLTE 2](http://almsaeedstudio.com/AdminLTE)
- Translations: English, Spanish, Russian, Ukrainian
- Translations Editor
- Language change action + behavior to choose locale based on browser preferred language 
- Sign in, Sign up, profile(avatar, locale, personal data) etc
- OAuth authorization
- User management
- RBAC with predefined `guest`, `user`, `manager` and `administrator` roles
- Content management components: articles, categories, static pages, editable menu, editable carousels, text blocks
- Key-value storage component
- Application settings form (based on KeyStorage component)
- Ready-to-go RESTful API module
- [File storage component + file upload widget](https://github.com/trntv/yii2-file-kit)
- On-demand thumbnail creation [trntv/yii2-glide](https://github.com/trntv/yii2-glide)
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
- Vagrant support
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
Starter Kit has fully configured and ready-to-go REST API module. You can access it on
http://yii2-starter-kit.dev/api/v1

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
- ``common\rbac\OwnModelRule`` - simple rule for RBAC to check if the current user is model owner

##Updates
Add remote repository `upstream`.
```
git remote add upstream https://github.com/trntv/yii2-starter-kit.git
```
Fetch latest changes from it
```
git fetch upstream
```
Merge these changes into your repository
```
git merge upstream/master
```
**IMPORTANT: there might be a conflicts between `upstream` and your code. You should resolve conflicts on your own**

##How to contribute?
You can contribute in any way you want. Any help appreciated, but most of all i need help with docs (^_^)

##Have any questions?
mail to [eugene@terentev.net](mailto:eugene@terentev.net)

##READ MORE
https://github.com/yiisoft/yii2/blob/master/apps/advanced/README.md
https://github.com/yiisoft/yii2/tree/master/docs

###NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can begin your application, rather than creating it from scratch.
Good luck!
