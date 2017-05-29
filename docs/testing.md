# Testing

##Assumptions:
 - Single domain
 - Docker style application setup

## Execution

1. cd to project root `cd /{path_to_project_root}`

2. Start containers: `docker-compose up -d`

3. Create database used for testing: `docker-compose exec db mysql -uroot -proot -e 'CREATE DATABASE yii2-starter-kit-test'`

4. Adjust `.env` file to set `TEST_DB_DSN`, `TEST_DB_USER` and `TEST_DB_PASSWORD` params if different from defaults

5. Setup application: `docker-compose exec app php tests/codeception/bin/yii app/setup`

6. Start web server (do not close bash session): `docker-compose exec app php -S localhost:8080`

7. Run tests in separate window: `docker-compose exec app vendor/bin/codecept run`