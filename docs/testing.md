# Testing

## Standard *AMP stack
To exec tests:

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
- exec tests:
```
cd tests
./tests/vendor/bin/codecept build
./tests/vendor/bin/codecept run
```

# Container Services
exec the following from the hosting machine:
Log into the app container and update dependencies

- Sadly running all tests at once does not work when using global ENV's as part of codeception configuration

```
docker-compose exec app bash

./tests/codeception/bin/yii app/setup --interactive=0
./vendor/bin/codecept build
```

### Common and Console
```
./vendor/bin/codecept run -c ./tests/codeception/common
./vendor/bin/codecept run -c ./tests/codeception/console
```


When using Codeception WebDriver and PHP server you must start the PHP server
in the web root.

### Frontend
```
php -S localhost:$HTTP_PORT -t ./frontend/web/ 2>&1 &
[ENTER]
./vendor/bin/codecept run -c ./tests/codeception/frontend
```
!stop web server!

### Backend
```
php -S localhost:$HTTP_PORT -t ./backend/web/ 2>&1 &
[ENTER]
./vendor/bin/codecept run -c ./tests/codeception/backend
```
!stop web server!
