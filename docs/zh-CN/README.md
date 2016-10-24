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


# 应用组件

### I18N
如果要将应用程序信息存储在DB中并且能够从后端编辑，请运行：
```
php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php
```
其会将现有语言包中的所有信息复制到数据库

然后在配置中取消对于 `DbMessageSource` 的注释
```php
common/config/base.php
```

### KeyStorage
Key storage是用于存储不同信息的键值存储。以应用程序设置为例。其值可以通过api或后端CRUD组件存储。
```
Yii::$app->keyStorage->set('articles-per-page', 20);
Yii::$app->keyStorage->get('articles-per-page'); // 20
```

### 维护模式
Starter Kit 具有内置组件以提供维护功能。因此你需要做的只是在配置中配置 ``maintenance`` 组件
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
此组件将捕获所有传入的请求，并设置正确的响应HTTP头（503, "Retry After"）与显示维护消息。其他配置选项可以在相应的类中找到。

如果 ``frontend.maintenance`` 在 KeyStorage 中被设置为 ``true``，则开启维护模式

### 命令总线
- [什么是命令总线？](http://shawnmc.cool/command-bus)

在 Starter Kit 中，其命令总线模式的实现，基于 [tactician](https://github.com/thephpleague/tactician) 软件包 及 其在yii2上的扩展 - [yii2-tactician](https://github.com/trntv/yii2-tactician)

命令存储在 ``common/commands/command`` 目录中, 处理程序在 ``common/commands/handler`` 目录中

执行命令运行
```php
$sendEmailCommand = new SendEmailCommand(['to' => 'user@example.org', 'body' => 'Hello User!']);
Yii::$app->commandBus->handle($sendEmailCommand);
```

### 时间轴（活动）
```php
$addToTimelineCommand = new AddToTimelineCommand([
    'category' => 'user', 
    'event' => 'signup', 
    'data' => ['foo' => 'bar']
]);
Yii::$app->commandBus->handle($addToTimelineCommand);
```

### 行为
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
在应用程序配置中添加：
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
它将允许仅对经过身份验证的用户访问您的应用程序。

### 命令总线
阅读更多关于命令总线的信息 [官方库](https://github.com/trntv/yii2-command-bus#yii2-command-bus)

### 在后端配置小部件
#### 轮播
1. 在后端创建轮播
2. 使用：
```php
<?php echo DbCarousel::widget(['key' => 'key-from-backend']) ?>
```

#### DbText
1. 在后端创建文本块
2. 使用：
```php
<?php echo DbText::widget(['key' => 'key-from-backend']) ?>
```

#### DbMenu
1. 在后端创建文本块
2. 使用：
```php
<?php echo DbMenu::widget(['key' => 'key-from-backend']) ?>
```

### 窗口小部件
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
Starter Kit 具有可全面配置和随时可用的REST API模块。您可以在 http://yii2-starter-kit.dev/api/v1 上访问它。
对于某些端点，您应该使用一种可用的方法来验证请求 - https://github.com/yiisoft/yii2/blob/master/docs/guide/rest-authentication.md#authentication

### 多模型
``common\base\MultiModel`` - 在一个控制器中处理多个模型的类：
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
视图：
```php
<?php echo $form->field($model->getModel('account'), 'username') ?>

<?php echo $form->field($model->getModel('profile'), 'middlename')->textInput(['maxlength' => 255]) ?>    
```
### 其他
- ``common\behaviors\GlobalAccessBehavior`` - 允许在应用程序配置中为您的应用程序设置访问规则

- ``common\behaviors\LocaleBehavior`` - 从浏览器或帐户设置中发现用户区域设置并进行相应设置

- ``common\behaviors\LoginTimestampBehavior`` - 用户登录日志

- ``common\validators\JsonValidator`` - 验证数据是否为有效的json

- ``common\rbac\rule\OwnModelRule`` - 基于RBAC检查当前用户是否是模型所有者的简单规则
```php
Yii::$app->user->can('editOwnModel', ['model' => $model]);
```

- ``common\filters\OwnModelAccessFilter`` - 检查用户是否被允许管理某模型的动作过滤器
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

##如何贡献？
你可以采用你所能够想像到的任何方式、任何帮助与赞赏，但我最需要的应该是文档方面的 (^_^)

##捐款
- [Paypal] (https://www.paypal.com/cgi-bin/webscr?cmd=_s-xclick&hosted_button_id=X7UFA3F3ALPM8)
- [Bitcoin] (https://www.coinbase.com/checkouts/2f1c1cb31c395e5aaafa1ba70003552e)
- [WebMoney] (Z110052695454)
- 其他方式： [eugene@terentev.net](mailto:eugene@terentev.net)

##有任何问题？
发送邮件至 [eugene@terentev.net](mailto:eugene@terentev.net)

##阅读更多
https://github.com/yiisoft/yii2/blob/master/apps/advanced/README.md
https://github.com/yiisoft/yii2/tree/master/docs

###备注
此模板主要是为开发人员创建的，而不是最终用户。
这是一个节点，你可以开始你的应用，而不是从头开始创建它。
祝你好运！

