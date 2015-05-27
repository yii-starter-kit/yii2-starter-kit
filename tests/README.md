To run tests:

1. Rename ``.env.dist`` to ``.env`` and edit it to set your local settings
2. Create ``yii2-starter-kit-test`` database
3. Apply migrations
```
php codeception/bin/yii migrate
```
4. Start web server
```
php -S localhost:8080
```
5. Run tests:
```
codecept run
```