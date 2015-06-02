## Command Bus
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
Description: TBD
```php
$addToTimelineCommand = new AddToTimelineCommand([
    'category' => 'user', 
    'event' => 'signup', 
    'data' => ['foo' => 'bar']
]);
Yii::$app->commandBus->handle($addToTimelineCommand);
```