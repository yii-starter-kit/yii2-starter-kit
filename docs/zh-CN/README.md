# Yii 2 入门套件

<!-- BADGES/ -->

[![Packagist](https://img.shields.io/packagist/v/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![Packagist](https://img.shields.io/packagist/dt/trntv/yii2-starter-kit.svg)](https://packagist.org/packages/trntv/yii2-starter-kit)
[![PayPal donate button](https://img.shields.io/badge/paypal-donate-yellow.svg)](https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7UFA3F3ALPM8 "Donate once-off to this project using Paypal")
[![Dependency Status](https://www.versioneye.com/php/trntv:yii2-starter-kit/badge.svg)](https://www.versioneye.com/php/trntv:yii2-starter-kit)
[![Build Status](https://travis-ci.org/trntv/yii2-starter-kit.svg?branch=master)](https://travis-ci.org/trntv/yii2-starter-kit)

<!-- /BADGES -->

这是一个基于Yii2启动应用程序开发的模板。

可在构建和开发一个基于Yii2的高级网站时，做到快速开始。

它涵盖了一个新项目的典型用例，并且将帮助您节省在每个项目中执行相同工作的时间

## 在你开始之前
请考虑通过[捐款](https://github.com/trntv/yii2-starter-kit/issues)或[捐赠](#donations)帮助该项目。 

## 目录
- [演示](#演示)
- [特征](#特征)
- [安装](docs/zh-CN/installation.md)
    - [手动安装](docs/zh-CN/installation.md#手动安装)
    - [Docker安装](docs/zh-CN/installation.md#Docker安装)
    - [Vagrant安装](docs/zh-CN/installation.md#Vagrant安装)
- [应用组件](#应用组件)
- [控制台命令](docs/zh-CN/console.md)
- [测试](docs/zh-CN/testing.md)
- [常问问题](docs/zh-CN/faq.md)
- [如何贡献？](#如何贡献？)
- [捐款](#捐款)
- [有任何问题](#有任何问题)

##演示
演示由 awesome [Digital Ocean](https://m.do.co/c/d7f000191ea8)提供支持

前端:
http://yii2-starter-kit.terentev.net

后端:
http://backend.yii2-starter-kit.terentev.net

`administrator` 帐户角色
```
Login: webmaster
Password: webmaster
```

`manager` 帐户角色
```
Login: manager
Password: manager
```

`user` 帐户角色
```
Login: user
Password: user
```

## 特征
- 漂亮和开源的后端仪表板主题 [AdminLTE 2](http://almsaeedstudio.com/AdminLTE)
- 翻译：英语，西班牙语，俄语，乌克兰语，中文
- 支持翻译的编辑器
- 语言更改操作+基于浏览器首选语言选择语言环境的行为
- 登录，注册，个人资料（头像，区域设置，个人数据），电子邮件激活等
- OAuth授权
- 用户管理
- RBAC具有预定义的 `guest`, `user`, `manager` and `administrator` 角色
- RBAC迁移支持
- 内容管理组件：文章，类别，静态页面，可编辑菜单，可编辑轮播，文本块
- Key-value 存储组件
- 应用程序设置表单（基于 KeyStorage 组件）
- 准备好的RESTful API模块
- [文件存储组件+文件上传部件](https://github.com/trntv/yii2-file-kit)
- 按需创建缩略图 [trntv/yii2-glide](https://github.com/trntv/yii2-glide)
- 具有队列和异步任务的命令总线支持 [trntv/yii2-command-bus](https://github.com/trntv/yii2-command-bus)
- 有用的行为 (GlobalAccessBehavior, CacheInvalidateBehavior, MaintenanceBehavior)
- Yii2日志的Web界面支持
- 应用程序时间轴组件
- 缓存web控制器
- 维护模式组件（[更多](#维护模式组件)）
- 系统信息的Web界面
- dotenv支持
- `ExtendedMessageController` 能够替换源语言并在消息源之间迁移消息
- [Aceeditor 小部件](https://github.com/trntv/yii2-aceeditor)
- [Datetimepicker 小部件](https://github.com/trntv/yii2-bootstrap-datetimepicker), 
- [Imperavi Reactor 小部件](https://github.com/asofter/yii2-imperavi-redactor), 
- [Elfinder 扩展](https://github.com/MihailDev/yii2-elfinder)
- [Xhprof 调试面板](https://github.com/trntv/yii2-debug-xhprof)
- IDE自动完成功能的扩展
- Nginx配置示例
- 测试就绪
- Docker支持与Vagrant支持
- 内置 [mailcatcher](http://mailcatcher.me/)
- 资源压缩和连接
- [一些有用的快捷函数(https://github.com/trntv/yii2-starter-kit/blob/master/common/helpers.php)
- 许多其他功能我懒得写:-)


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

##How to contribute?
You can contribute in any way you want. Any help appreciated, but most of all i need help with docs (^_^)

##Donations
- [Paypal] (https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7UFA3F3ALPM8)
- [Bitcoin] (https://www.coinbase.com/checkouts/2f1c1cb31c395e5aaafa1ba70003552e)
- [WebMoney] (Z110052695454)
- Other way: [eugene@terentev.net](mailto:eugene@terentev.net)

##Have any questions?
mail to [eugene@terentev.net](mailto:eugene@terentev.net)

##READ MORE
https://github.com/yiisoft/yii2/blob/master/apps/advanced/README.md
https://github.com/yiisoft/yii2/tree/master/docs

###NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can begin your application, rather than creating it from scratch.
Good luck!

