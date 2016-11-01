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
./tests/vendor/bin/codecept build
./tests/vendor/bin/codecept run
```

# container env
Run the following from the hosting machine:
Log into the app container and update dependencies

```
docker-compose exec app bash
php composer.phar install -o -vvv
```

Setup the testing requirements
```
docker-compose exec app bash
tests/codeception/bin/yii app/setup --interactive=0
php -S localhost:${HTTP_PORT} 2>&1 &
./vendor/bin/codecept build
```

- Sadly running all tests at once does not work when using global ENV's as part of codeception configuration

Frontend:
php -S localhost:$HTTP_PORT -t ./frontend/web/

```
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/backend
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/common
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/console
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/frontend
```
