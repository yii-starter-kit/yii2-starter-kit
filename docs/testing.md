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
php composer.phar update -o -vvv
exit
```

Setup the testing requirements
```
docker-compose exec app tests/codeception/bin/yii app/setup --interactive=0
docker-compose exec app php -S localhost:8080 > /tmp/php.localhost 2>&1 &
docker-compose exec app ./vendor/bin/codecept build
```

- Sadly running all tests at once doe snot work when using global ENV's as part of codeception configuration
```
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/backend
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/common
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/console
docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/frontend
```
