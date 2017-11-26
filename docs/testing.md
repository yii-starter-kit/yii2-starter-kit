# Testing

To run tests:
1. Start containers:
```
docker-compose up -d
```
2. Create `tests` database:
```
docker-compose exec db mysql -uroot -proot -e "CREATE DATABASE \`yii2-starter-kit-test\`" 
```

3. Adjust `.env` file to set `TEST_DB_DSN`, `TEST_DB_USER` and `TEST_DB_PASSWORD` params
4. Setup application:
```
docker-compose exec app php tests/codeception/bin/yii app/setup --interactive=0
```
5. Truncate tables before run, so we have fresh database without records.
```
docker-compose exec app php tests/codeception/bin/yii app/truncate
```
6. Start web server (do not close bash session):
```
docker-compose exec app php -S localhost:8080
```
7. Run tests in separate window:
```
docker-compose exec app vendor/bin/codecept run
```
