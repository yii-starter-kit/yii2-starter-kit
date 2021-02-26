# Testing

## Automated

```
composer run-script docker:tests
```

## Manual

To run tests:
1. Start containers:
```
docker-compose up -d
```
2. Create `tests` database:
```
docker-compose exec db mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`yii2-starter-kit-test\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
```
3. Build needed files
```
docker-compose exec app ./vendor/bin/codecept build
```
4. Setup application:
```
docker-compose exec app php tests/bin/yii app/setup --interactive=0
```
5. Start web server for acceptance tests (do not close bash session):
```
docker-compose exec app php -S localhost:8080
```
6. Run tests in separate window:
```
docker-compose exec app vendor/bin/codecept run
```
