## API
Starter Kit has fully configured and ready-to-use REST API module. You can access it on http://yii2-starter-kit.localhost/api/v1
For some endpoints you should authenticate your requests with one of available methods - https://github.com/yiisoft/yii2/blob/master/docs/guide/rest-authentication.md#authentication
## Timeline (Activity)
```php
$addToTimelineCommand = new AddToTimelineCommand([
    'category' => 'user', 
    'event' => 'signup', 
    'data' => ['foo' => 'bar']
]);
Yii::$app->commandBus->handle($addToTimelineCommand);
```

## I18N
If you want to store application messages in DB and to have ability to edit them from backend, run:
```
php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php
```
it will copy all existing messages to database

Then uncomment config for `DbMessageSource` in
```php
common/config/base.php
```
``common\behaviors\LocaleBehavior`` - discovers user locale from browser's predefined language or account settings

## Queue

Basic [Queueing](https://github.com/yiisoft/yii2-queue) component
implementation a file based  queueing service.

Additional module [readme](https://github.com/yiisoft/yii2-queue/blob/master/README.md).

Implement Queue class

```php
class DownloadJob extends BaseObject implements \yii\queue\JobInterface
{
    public $url;
    public $file;

    public function execute($queue)
    {
        file_put_contents($this->file, file_get_contents($this->url));
    }
}
```

Here's how to send a task into queue:

```php
Yii::$app->queue->push(new DownloadJob([
    'url' => 'http://example.com/image.jpg',
    'file' => '/tmp/image.jpg',
]));
```

Pushes job into queue that run after 5 min:

```php
Yii::$app->queue->delay(5 * 60)->push(new DownloadJob([
    'url' => 'http://example.com/image.jpg',
    'file' => '/tmp/image.jpg',
]));
```

Command that obtains and executes tasks in a loop until queue is empty:

```
php ./console/yii  queue/run
```
Command launches a daemon which infinitely queries the queue:

```
php ./console/yii queue/listen
```
[See additional documentation](https://github.com/yiisoft/yii2-queue/blob/master/README.md) for more details about driver console commands and their options.

## Key-Value storage
Key storage is a key-value storage to store different information. Application settings for example.
Values can be stored both via api or by backend CRUD component.
```
Yii::$app->keyStorage->set('articles-per-page', 20);
Yii::$app->keyStorage->get('articles-per-page'); // 20
```

## Maintenance mode
Starter kit has built-in component to provide a maintenance functionality. All you have to do is to configure ``maintenance``
component in your config
```php
'bootstrap' => ['maintenance'],
...
'components' => [
    ...
    'maintenance' => [
        'class' => 'common\components\maintenance\Maintenance',
        'enabled' => Astronomy::isAFullMoonToday(),
        'statusCode' => ''
    ]
    ...
]
```
This component will catch all incoming requests, set proper response HTTP headers (503, "Retry After") and show a maintenance message.
Additional configuration options can be found in a corresponding class.

Starter kit configured to turn on maintenance mode if ``frontend.maintenance`` key in KeyStorage is set to ``true`` or ``APP_MAINTENANCE`` environment variable set ot ``1``

## Useful behaviors
### CacheInvalidateBehavior
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
Allows to set access rules for your application in application config.
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

## Command Bus
Read more about command bus on in [official repository](https://github.com/trntv/yii2-command-bus#yii2-command-bus)

## Widgets configurable from backend
### Carousel
1. Create carousel in backend
2. Use it:
```php
<?php echo DbCarousel::widget(['key' => 'key-from-backend']) ?>
```

### DbText
1. Create text block in backend
2. Use it:
```php
<?php echo DbText::widget(['key' => 'key-from-backend']) ?>
```

### DbMenu
1. Create text block in backend
2. Use it:
```php
<?php echo DbMenu::widget(['key' => 'key-from-backend']) ?>
```

## Widgets
- [WYSIWYG Redactor widget](https://github.com/asofter/yii2-imperavi-redactor)  
- [DateTime picker](https://github.com/trntv/yii2-bootstrap-datetimepicker)
- [Ace Editor](https://github.com/trntv/yii2-aceeditor)
- [File upload](https://github.com/trntv/yii2-file-kit)
- [ElFinder](https://github.com/MihailDev/yii2-elfinder)


## Grid
### EnumColumn
```php
 [
      'class' => '\common\grid\EnumColumn',
      'attribute' => 'status',
      'enum' => User::getStatuses() // [0=>'Deleted', 1=>'Active']
 ]
```

## MultiModel
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

## Other
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
