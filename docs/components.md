# Components

The pieces this starter kit adds on top of Yii 2, with the configuration each one needs.

## API

The REST API is a separate application, served from `api.yii2-starter-kit.localhost`. Swagger UI is
at the root of that host and the resources live under `/v1`, for example:

- `GET http://api.yii2-starter-kit.localhost/v1/articles`
- `GET http://api.yii2-starter-kit.localhost/v1/articles/{id}`

Some endpoints require authentication. See the
[Yii 2 REST authentication guide](https://github.com/yiisoft/yii2/blob/master/docs/guide/rest-authentication.md#authentication).

## Timeline (Activity)
```php
use common\commands\AddToTimelineCommand;

$addToTimelineCommand = new AddToTimelineCommand([
    'category' => 'user',
    'event' => 'signup',
    'data' => ['foo' => 'bar']
]);
Yii::$app->commandBus->handle($addToTimelineCommand);
```

## I18N
If you want to store application messages in DB and to have ability to edit them from backend, run:
```bash
php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php
```

This copies every existing message into the database. Then uncomment the `DbMessageSource` block in
`common/config/base.php`.

`common\behaviors\LocaleBehavior` detects the user locale from the browser's accepted languages or
from the account settings.

## Queue

The queue component is [yiisoft/yii2-queue](https://github.com/yiisoft/yii2-queue) and uses the file
driver by default, which keeps jobs in `common/runtime/queue`.

A job implements `yii\queue\JobInterface`:

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

Push a job into the queue:

```php
Yii::$app->queue->push(new DownloadJob([
    'url' => 'http://example.com/image.jpg',
    'file' => '/tmp/image.jpg',
]));
```

Push a job that runs five minutes later:

```php
Yii::$app->queue->delay(5 * 60)->push(new DownloadJob([
    'url' => 'http://example.com/image.jpg',
    'file' => '/tmp/image.jpg',
]));
```

Process the queue until it is empty:

```bash
php console/yii queue/run
```

Run a worker that keeps polling the queue:

```bash
php console/yii queue/listen
```

See the [queue documentation](https://github.com/yiisoft/yii2-queue/blob/master/README.md) for the
driver commands and their options.

## Key-Value storage

`common\components\keyStorage\KeyStorage` stores arbitrary values as key-value pairs, which is how
the application settings and the maintenance flag are kept. Values can be written from the code, the
API or the backend CRUD screens.

```php
Yii::$app->keyStorage->set('articles-per-page', 20);
Yii::$app->keyStorage->get('articles-per-page'); // 20
```

## Maintenance mode

`common\components\maintenance\Maintenance` catches incoming requests, answers with `503` and a
`Retry-After` header, and renders a maintenance page instead of the application.

The frontend and the API register it, and it turns on when either condition holds:

- `APP_MAINTENANCE=1` in `.env`, documented in [configuration.md](configuration.md#framework);
- the `frontend.maintenance` key in KeyStorage holds the string `enabled`.

This is the component as `frontend/config/web.php` declares it:

```php
'maintenance' => [
    'class' => common\components\maintenance\Maintenance::class,
    'enabled' => function ($app) {
        if (env('APP_MAINTENANCE') === '1') {
            return true;
        }
        return $app->keyStorage->get('frontend.maintenance') === 'enabled';
    },
],
```

Add `'maintenance'` to the `bootstrap` array of each application you want to protect. The class
accepts `statusCode` and a custom view as well.

## Useful behaviors
### CacheInvalidateBehavior
```php
 public function behaviors()
 {
     return [
         [
             'class' => common\behaviors\CacheInvalidateBehavior::class,
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
### GlobalAccessBehavior
Sets access rules for an application from its configuration.
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
In this example the application is reachable only for authenticated users.

## Command Bus
Read more about command bus on in [official repository](https://github.com/trntv/yii2-command-bus#yii2-command-bus)

## Widgets configurable from backend
### Carousel
1. Create a carousel in the backend
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
1. Create a menu in the backend
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
`common\base\MultiModel` treats several models as one.
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
- `common\behaviors\LoginTimestampBehavior` records the last login time

- `common\validators\JsonValidator` validates that a value is valid JSON

- `common\rbac\rule\OwnModelRule` is an RBAC rule that checks whether the current user owns the model
```php
Yii::$app->user->can('editOwnModel', ['model' => $model]);
```

- `common\filters\OwnModelAccessFilter` is an action filter that checks whether the user may manage this model
```php
public function behaviors()
    {
        return [
            'modelAccess' => [
                'class' => OwnModelAccessFilter::class,
                'only' => ['view', 'update', 'delete'],
                'modelCreatedByAttribute' => 'created_by',
                'modelClass' => Article::class
            ],
        ];
    }
```
