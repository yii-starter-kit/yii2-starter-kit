# Testing

## Structure

Tests are now organized per application:
- `backend/tests/` - Backend application tests (unit, functional, acceptance)
- `frontend/tests/` - Frontend application tests (unit, functional, acceptance)
- `api/tests/` - API tests (functional, unit)
- `console/tests/` - Console application tests (unit)
- `tests/common/` - Shared tests for common models and components
- `tests/config/` - Test configuration files

This structure follows Codeception 5 best practices.

## Automated
```bash
taskctl docker:tests
```
or
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

## Running specific test suites

To run tests for a specific application:
```bash
# Backend tests
vendor/bin/codecept run -c backend/tests

# Frontend tests
vendor/bin/codecept run -c frontend/tests

# API tests
vendor/bin/codecept run -c api/tests

# Console tests
vendor/bin/codecept run -c console/tests
```
