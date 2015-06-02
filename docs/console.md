# Console
### AppController
TBD

### ExtendedMessageController
This controller extends default MessageController to provide some useful actions:

- Migrate messages between different message sources:
``yii message/migrate @common/config/messages/php.php @common/config/messages/db.php``

- Replace source code language:
``yii message/replace-source-language @common/config/messages/php.php ru-RU``
or any other locale

- Remove ``Yii::t`` from source code at all
``yii message/replace-source-language @common/config/messages/php.php``