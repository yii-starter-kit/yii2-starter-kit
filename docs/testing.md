# Testing

To run tests:

- Create `yii2-starter-kit-test` database
- Adjust `.env` file to set `TEST_DB_DSN`, `TEST_DB_USER` and `TEST_DB_PASSWORD` params
- Setup application
```
php tests/codeception/bin/yii app/setup
```
- Start web server
```
php -S localhost:8080
```
- Run tests:
```
cd tests
./../vendor/bin/codecept run
```