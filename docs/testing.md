# Testing

The suite runs on Codeception 5 and covers five applications: `api`, `backend`, `common`,
`console` and `frontend`.

## Automated

```bash
make test         # in Docker, the same command CI runs
make test-local   # against a MySQL server you run on the host
```

`make test` starts the stack, creates the `yii2-starter-kit-test` database, runs `codecept build`,
applies the migrations to the test database and runs the suite. `make test-local` assumes a test
database matching `TEST_DB_DSN`, `TEST_DB_USERNAME` and `TEST_DB_PASSWORD` already exists.

Alternatives:

```bash
taskctl docker:tests
composer run-script docker:tests
```

`composer run-script docker:tests` leaves the acceptance web server in the foreground, so run the
suite from a second terminal.

## Manual

1. Start the containers:

    ```bash
    docker compose up -d
    ```

2. Create the test database:

    ```bash
    docker compose exec db mysql -uroot -proot -e "CREATE DATABASE IF NOT EXISTS \`yii2-starter-kit-test\` CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci"
    ```

3. Build the actor classes:

    ```bash
    docker compose exec console ./vendor/bin/codecept build
    ```

4. Prepare the test application:

    ```bash
    docker compose exec console php tests/bin/yii app/setup --interactive=0
    ```

5. Start the web server the acceptance suites talk to, and leave it running:

    ```bash
    docker compose exec console php -S localhost:8080
    ```

6. Run the suite from another terminal:

    ```bash
    docker compose exec console vendor/bin/codecept run
    ```

Run one application or one test by appending a suite name and a path:

```bash
docker compose exec console vendor/bin/codecept run backend
docker compose exec console vendor/bin/codecept run frontend ArticleCest
```

Failures, screenshots and reports land in `tests/_output`.
