Yii 2 Starter Kit
================================
This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2. 

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

## TABLE OF CONTENTS
- [Features](#features)
- [Demo](#demo)
- [Installation](#installation)
- [Application components](#application-components)
- [Updates](#updates)
- [How to contribute?](#how-to-contribute)
- [Have any questions](#have-any-questions)
 
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

##REQUIREMENTS
The minimum requirement by this application template that your Web server supports PHP 5.4.0.


##INSTALLATION
### Before installation
If you do not have [Composer](http://getcomposer.org/), you may install it by following the instructions
at [getcomposer.org](http://getcomposer.org/doc/00-intro.md#installation-nix).

Install composer-asset-plugin needed for yii assets management
```bash
composer global require "fxp/composer-asset-plugin"
```

### Clone from GitHub

Extract the github archive file or clone this repository.
```bash
git clone https://github.com/trntv/yii2-starter-kit.git
```

After clone run
```
composer install
```

### Install via Composer

You can install this application template with `composer` using the following command:

```
composer create-project --prefer-dist --stability=dev trntv/yii2-starter-kit
```

Application configuration process include:

1. [Initialise application](#1-initialization)
2. [Web server configuration](#2-web-server-configuration)
3. [Configure environment](#3-setup-environment)
4. [Apply migrations](#4-apply-migrations)
5. [Initialise RBAC](#5-initialise-rbac-config)

### Vagrant
If you want, you can use bundled Vagrant instead of installing app to your local machine.
1. Install [Vagrant](https://www.vagrantup.com/)
2. Rename `vagrant.dist.yaml` to `vagrant.yaml`
3. Create GitHub [personal API token](https://github.com/blog/1509-personal-api-tokens) and paste in into `vagrant.yml`
4. Run:
```
vagrant plugin install vagrant-hostmanager
vagrant up
```
That`s all. After provision application will be accessible on http://yii2-starter-kit.dev

#### 1. Initialization
Initialise application
```
./init #init.bat for windows
```

#### 2. Web server configuration 

You should configure web server with three different web roots:

`yii2-starter-kit.dev` => `/path/to/yii2-starter-kit/frontend/web`

`backend.yii2-starter-kit.dev` => `/path/to/yii2-starter-kit/backend/web`

`storage.yii2-starter-kit.dev` => `/path/to/yii2-starter-kit/storage`

**NOTE:** You can use `nginx.conf` file that is located in the project root.

#### 3. Setup environment
Adjust settings in `.env` file

##### 3.1 Database
Edit the file `.env` with your data:
```
DB_DSN           = mysql:host=127.0.0.1;port=3306;dbname=yii2-starter-kit
DB_USERNAME      = user
DB_PASSWORD      = password
```
**NOTE:** Yii won't create the database for you, this has to be done manually before you can access it.


##### 3.2 Application urls
Set your current application urls in `.env`

```php
FRONTEND_URL    = http://yii2-starter-kit.dev
BACKEND_URL     = http://backend.yii2-starter-kit.dev
STORAGE_URL     = http://storage.yii2-starter-kit.dev
```
#### 4. Apply migrations

```php
php console/yii migrate
```

#### 5. Initialise RBAC config

```php
php console/yii rbac/init
```
**IMPORTANT: without rbac/init you CAN'T LOG IN into backend**

### Demo user
```
Login: webmaster
Password: webmaster
```

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

### ExtendedMessageController
This controller extends default MessageController to provide some useful actions

Migrate messages between different message sources:
``yii message/migrate @common/config/messages/php.php @common/config/messages/db.php``

Replace source code language:
``yii message/replace-source-language @path language-LOCALE``

Remove Yii::t from code
``yii message/replace-source-language @path``

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
