# Testing

To run tests:
1. Rename ``tests/.env.dist`` to ``tests/.env`` and edit it to set your local settings
2. Create ``yii2-starter-kit-test`` database
3. Setup application
```
php tests/codeception/bin/yii app/setup
```
4. Start web server
```
php -S localhost:8080
```
5. Run tests:
```
codecept run
```