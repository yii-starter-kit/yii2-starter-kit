# Console
## AppController
``php console/yii app/setup`` 

## ExtendedMessageController
This controller extends default MessageController to provide some useful actions:

- Migrate messages between different message sources:
``php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php``

- Replace source code language:
``php console/yii message/replace-source-language @common/config/messages/php.php ru-RU``
or any other locale

- Remove ``Yii::t`` from source code at all
``php console/yii message/replace-source-language @common/config/messages/php.php``

## RbacMigrateController
Provides migrate functionality for RBAC.

``php console/yii rbac-migrate/create init_roles``

``php console/yii rbac-migrate/up``

``php console/yii rbac-migrate/down all``

### Compress assets
You need to have yuicompressor and uglifyjs installed.

```php console/yii asset/compress frontend/config/assets/compress.php frontend/config/assets/_bundles.php```

then uncomment these lines in the ``frontend/config/web.php``
```
// Compressed assets
//$config['components']['assetManager'] = [
//   'bundles' => require(__DIR__ . '/assets/_bundles.php')
//];
```
