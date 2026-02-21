![GitHub Workflow Status](https://img.shields.io/github/workflow/status/yii2-starter-kit/yii2-file-kit/Tests) ![Packagist Version (custom server)](https://img.shields.io/packagist/v/yii2-starter-kit/yii2-file-kit) ![Packagist](https://img.shields.io/packagist/dm/yii2-starter-kit/yii2-file-kit)

This kit is designed to automate routine processes of uploading files, their saving and storage.
It includes:
- File upload widget (based on [Blueimp File Upload](https://github.com/blueimp/jQuery-File-Upload))
- Component for storing files (built on top of [flysystem](https://github.com/thephpleague/flysystem))
- Actions to download, delete, and view (download) files
- Behavior for saving files in the model and delete files when you delete a model

Here you can see list of available [filesystem adapters](https://github.com/thephpleague/flysystem#adapters)

Demo
----
Since file kit is a part of [yii2-starter-kit](https://github.com/yii2-starter-kit/yii2-starter-kit) it's demo can be found in starter kit demo [here](http://backend.yii2-starter-kit.terentev.net/content/article/create).

# Installation
The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require yii2-starter-kit/yii2-file-kit
```

or add

```
"yii2-starter-kit/yii2-file-kit": "@stable"
```

to the require section of your `composer.json` file.

# File Storage
To work with the File Kit you need to configure FileStorage first. This component is a layer of abstraction over the filesystem
- Its main task to take on the generation of a unique name for each file and trigger corresponding events.
```php
'fileStorage'=>[
    'class' => 'trntv\filekit\Storage',
    'useDirindex' => true,
    'baseUrl' => '@web/uploads'
    'filesystem'=> ...
        // OR
    'filesystemComponent' => ...
],
```
There are several ways to configure `trntv\filekit\Storage` to work with `flysystem`.

## Using Closure
```php
'fileStorage'=>[
    ...
    'filesystem'=> function() {
        $adapter = new \League\Flysystem\Adapter\Local('some/path/to/storage');
        return new League\Flysystem\Filesystem($adapter);
    }
]
```
## Using filesystem builder
- Create a builder class that implements `trntv\filekit\filesystem\FilesystemBuilderInterface` and implement method `build` which returns filesystem object. See ``examples/``
- Add to your configuration:
```php
'fileStorage'=>[
    ...
    'filesystem'=> [
        'class' => 'app\components\FilesystemBuilder',
        'path' => '@webroot/uploads'
        ...
    ]
]
```
Read more about flysystem at http://flysystem.thephpleague.com/

## Using third-party extensions
- Create filesystem component (example uses `creocoder/yii2-flysystem`)
```php
'components' => [
    ...
    'fs' => [
        'class' => 'creocoder\flysystem\LocalFilesystem',
        'path' => '@webroot/files'
    ],
    ...
]
```
- Set filesystem component name in storage configuration:
```php
'components' => [
    ...
    'fileStorage'=>[
        'filesystemComponent'=> 'fs'
    ],
    ...
]
```

# Actions
File Kit contains several Actions to work with uploads.

### Upload Action
Designed to save the file uploaded by the widget
```php
public function actions(){
    return [
           'upload'=>[
               'class'=>'trntv\filekit\actions\UploadAction',
               //'deleteRoute' => 'my-custom-delete', // my custom delete action for deleting just uploaded files(not yet saved)
               //'fileStorage' => 'myfileStorage', // my custom fileStorage from configuration
               'multiple' => true,
               'disableCsrf' => true,
               'responseFormat' => Response::FORMAT_JSON,
               'responsePathParam' => 'path',
               'responseBaseUrlParam' => 'base_url',
               'responseUrlParam' => 'url',
               'responseDeleteUrlParam' => 'delete_url',
               'responseMimeTypeParam' => 'type',
               'responseNameParam' => 'name',
               'responseSizeParam' => 'size',
               'deleteRoute' => 'delete',
               'fileStorage' => 'fileStorage', // Yii::$app->get('fileStorage')
               'fileStorageParam' => 'fileStorage', // ?fileStorage=someStorageComponent
               'sessionKey' => '_uploadedFiles',
               'allowChangeFilestorage' => false,
               'validationRules' => [
                    ...
               ],
               'on afterSave' => function($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file
                    // do something (resize, add watermark etc)
               }
           ]
       ];
}
```
See additional settings in the corresponding class

### Delete Action
```php
public function actions(){
    return [
       'delete'=>[
           'class'=>'trntv\filekit\actions\DeleteAction',
           //'fileStorage' => 'fileStorageMy', // my custom fileStorage from configuration(such as in the upload action)
       ]
    ];
}
```
See additional settings in the corresponding class

### View (Download) Action
```php
public function actions(){
    return [
       'view'=>[
           'class'=>'trntv\filekit\actions\ViewAction',
       ]
    ];
}
```
See additional settings in the corresponding class

# Upload Widget
Standalone usage
```php
echo \trntv\filekit\widget\Upload::widget([
    'model' => $model,
    'attribute' => 'files',
    'url' => ['upload'],
    'uploadPath' => 'subfolder', // optional, for storing files in storage subfolder
    'sortable' => true,
    'maxFileSize' => 10 * 1024 * 1024, // 10Mb
    'minFileSize' => 1 * 1024 * 1024, // 1Mb
    'maxNumberOfFiles' => 3, // default 1,
    'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    'showPreviewFilename' => false,
    'editFilename' => false,
    'clientOptions' => [/* ...other blueimp options... */]
]);
```

Standalone usage - without model
```php
echo \trntv\filekit\widget\Upload::widget([
    'name' => 'filename',
    'hiddenInputId' => 'filename', // must for not use model
    'url' => ['upload'],
    'uploadPath' => 'subfolder', // optional, for storing files in storage subfolder
    'sortable' => true,
    'maxFileSize' => 10 * 1024 * 1024, // 10Mb
    'minFileSize' => 1 * 1024 * 1024, // 1Mb
    'maxNumberOfFiles' => 3, // default 1,
    'acceptFileTypes' => new \yii\web\JsExpression('/(\.|\/)(gif|jpe?g|png)$/i'),
    'showPreviewFilename' => false,
    'editFilename' => false,
    'clientOptions' => [/* ...other blueimp options... */]
]);
```

With ActiveForm
```php
echo $form->field($model, 'files')->widget(
    '\trntv\filekit\widget\Upload',
    [
        'url' => ['upload'],
        'uploadPath' => 'subfolder', // optional, for storing files in storage subfolder
        'sortable' => true,
        'maxFileSize' => 10 * 1024 * 1024, // 10 MiB
        'maxNumberOfFiles' => 3,
        'clientOptions' => [/* ...other blueimp options... */]
    ]
);
```
## Upload Widget events
Upload widget trigger some of built-in blueimp events:
- start
- fail
- done
- always

You can use them directly or add your custom handlers in options:
```php
'clientOptions' => [
    'start' => new JsExpression('function(e, data) { ... do something ... }'),
    'done' => new JsExpression('function(e, data) { ... do something ... }'),
    'fail' => new JsExpression('function(e, data) { ... do something ... }'),
    'always' => new JsExpression('function(e, data) { ... do something ... }'),
 ]
```

# UploadBehavior
This behavior is designed to save uploaded files in the corresponding relation.

Somewhere in model:

For multiple files
```php
 public function behaviors()
 {
    return [
        'file' => [
            'class' => 'trntv\filekit\behaviors\UploadBehavior',
            'filesStorage' => 'myfileStorage', // my custom fileStorage from configuration(for properly remove the file from disk)
            'multiple' => true,
            'attribute' => 'files',
            'uploadRelation' => 'uploadedFiles',
            'pathAttribute' => 'path',
            'baseUrlAttribute' => 'base_url',
            'typeAttribute' => 'type',
            'sizeAttribute' => 'size',
            'nameAttribute' => 'name',
            'orderAttribute' => 'order'
        ],
    ];
 }
```

For single file upload
```php
 public function behaviors()
 {
     return [
          'file' => [
              'class' => 'trntv\filekit\behaviors\UploadBehavior',
              'filesStorage' => 'fileStorageMy', // my custom fileStorage from configuration(for properly remove the file from disk)
              'attribute' => 'file',
              'pathAttribute' => 'path',
              'baseUrlAttribute' => 'base_url',
               ...
          ],
      ];
 }
```

See additional settings in the corresponding class.

# Validation
There are two ways you can perform validation over uploads.
On the client side validation is performed by Blueimp File Upload.
Here is [documentation](https://github.com/blueimp/jQuery-File-Upload/wiki/Options#validation-options) about available options.

On the server side validation is performed by [[yii\web\UploadAction]], where you can configure validation rules for
[[yii\base\DynamicModel]] that will be used in validation process

# Tips
## Adding watermark
Install ``intervention/image`` library
```
composer require intervention/image
```
Edit your upload actions as so
```
public function actions(){
    return [
           'upload'=>[
               'class'=>'trntv\filekit\actions\UploadAction',
               ...
               'on afterSave' => function($event) {
                    /* @var $file \League\Flysystem\File */
                    $file = $event->file;

                    // create new Intervention Image
                    $img = Intervention\Image\ImageManager::make($file->read());

                    // insert watermark at bottom-right corner with 10px offset
                    $img->insert('public/watermark.png', 'bottom-right', 10, 10);

                    // save image
                    $file->put($img->encode());
               }
               ...
           ]
       ];
}
```
