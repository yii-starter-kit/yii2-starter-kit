Yii2 Glide
==========
Yii2 Glide integration.
> Glide is a wonderfully easy on-demand image manipulation library written in PHP.

Before you start read [Glide documentation](http://glide.thephpleague.com/) to understand what we are doing

Demo
----
Since this package was created as a part of [yii2-starter-kit](https://github.com/trntv/yii2-starter-kit) it's demo can be found in starter kit demo.

Contributing
-----------
You can contribute anything you found useful in any convenient way. Any help appreciated.


Installation
------------

The preferred way to install this extension is through [composer](http://getcomposer.org/download/).

Either run

```
php composer.phar require --prefer-dist trntv/yii2-glide
```

or add

```
"trntv/yii2-glide": "^1.0"
```

to the require section of your `composer.json` file.


Usage
-----

Add glide configuration:

```php
'components' => [
    ...
    'glide' => [
        'class' => 'trntv\glide\components\Glide',
        'sourcePath' => '@app/web/uploads',
        'cachePath' => '@runtime/glide',
        'signKey' => '<random-key>' // "false" if you do not want to use HTTP signatures
    ],
    ...
]
```

Then you can output modified image like so:
```php
Yii::$app->glide->outputImage('new-upload.jpg', ['w' => 100, 'fit' => 'crop'])
```

You can also use ``trntv\glide\actions\GlideAction`` to output images:
In any controller add (``SiteController`` for example):
```php
public function actions()
{
    return [
        'glide' => 'trntv\glide\actions\GlideAction'
    ]
}
```
Than use it:
``/index.php?r=site/glide?path=new-upload.jpg&w=100&h=75``

Example
-------
Complex Glide integration example can be found [here](https://github.com/trntv/yii2-starter-kit/tree/master/storage)



Secure Urls
-----------
TBD
