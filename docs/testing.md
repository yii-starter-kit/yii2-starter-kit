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
./../vendor/bin/codecept build
./../vendor/bin/codecept run
```

# container env
Run the following from the hosting machine:
`docker-compose exec app php -S localhost:8080 > /dev/null 2>&1 &`
`docker-compose exec app tests/codeception/bin/yii app/setup --interactive=0`
`docker-compose exec app ./vendor/bin/codecept build`
`docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/common`
`docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/backend`
`docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/frontend`
`docker-compose exec app ./vendor/bin/codecept run -c ./tests/codeception/console`
 - Sadly running all tests at once doe snot work when using global ENV's as part of codeception configuration

To use phatomJs (visual browser emulation) the following MUST be run INSIDE
the application container (phantomJs build is platform dependant)
`php composer.phar update`
Wait for install to finish