# Configuration

Runtime configuration comes from the `.env` file in the project root. `common/env.php` loads it with
`phpdotenv` in immutable mode before Yii boots, so every value is available to the configuration
files in `common/config`, `frontend/config`, `backend/config`, `api/config` and `storage/config`.

Create the file with `make env`, which copies `.env.dist`, then edit it. `.env` is gitignored and
must never be committed. `env()` returns `null` for a missing key unless a default is passed, and
only three call sites pass one: `YII_ENV` falls back to `prod`, `DB_CHARSET` to `utf8mb4` and
`LINK_ASSETS` to `false`.

## Framework

| Variable | Values | Effect |
| --- | --- | --- |
| `YII_DEBUG` | `true`, `false` | Enables the debug toolbar and Gii, raises the log trace level to 3 and appends timestamps to published assets |
| `YII_ENV` | `dev`, `prod` | `dev` switches caches to `DummyCache` and sends mail over SMTP. `prod` enables the schema cache, the email log target and `FileCache` |
| `APP_MAINTENANCE` | `1`, `0` | `1` puts the frontend and the API into maintenance mode |

## Application

| Variable | Values | Effect |
| --- | --- | --- |
| `LINK_ASSETS` | `true`, `false` | `true` symlinks published assets instead of copying them, which is faster during development. A missing value means `false`; `.env.dist` ships `true` |

## Database

| Variable | Values | Effect |
| --- | --- | --- |
| `DB_DSN` | PDO DSN | Connection string, for example `mysql:host=db;port=3306;dbname=yii2-starter-kit` |
| `DB_USERNAME` | string | Database user |
| `DB_PASSWORD` | string | Database password |
| `DB_TABLE_PREFIX` | string | Prefix applied to every table, empty by default |
| `DB_CHARSET` | string | Connection charset, `utf8mb4` by default |
| `TEST_DB_DSN` | PDO DSN | Database used by the Codeception suites |
| `TEST_DB_USERNAME` | string | Test database user |
| `TEST_DB_PASSWORD` | string | Test database password |

The Docker stack creates the `yii2-starter-kit` database and the `ysk_dbu` user. The test database
is created by the `make test` target.

## URLs

Every application has a host and an optional base path. `common/config/bootstrap.php` joins each
pair into the `@apiUrl`, `@frontendUrl`, `@backendUrl` and `@storageUrl` aliases, and
`common/config/base.php` passes the same pair to the matching `urlManager`.

| Variable | Example | Notes |
| --- | --- | --- |
| `API_HOST_INFO` | `http://api.yii2-starter-kit.localhost` | Scheme and host only |
| `API_BASE_URL` | empty | Path prefix. It is not in `.env.dist`; add it when the API is served from a subdirectory |
| `FRONTEND_HOST_INFO` | `http://yii2-starter-kit.localhost` | Scheme and host only |
| `FRONTEND_BASE_URL` | empty | `/` for a single domain installation |
| `BACKEND_HOST_INFO` | `http://backend.yii2-starter-kit.localhost` | Scheme and host only |
| `BACKEND_BASE_URL` | empty | `/backend/web` for a single domain installation |
| `STORAGE_HOST_INFO` | `http://storage.yii2-starter-kit.localhost` | Scheme and host only |
| `STORAGE_BASE_URL` | empty | `/storage/web` for a single domain installation |

[installation.md](installation.md#single-domain-installation) walks through the single domain
combination.

## Mail

| Variable | Values | Effect |
| --- | --- | --- |
| `SMTP_HOST` | host name | Mail server used when `YII_ENV=dev` |
| `SMTP_PORT` | port number | Mail server port, `1025` for Mailpit |
| `ADMIN_EMAIL` | address | Sender of application mail and recipient of error notifications in `prod` |
| `ROBOT_EMAIL` | address | Sender of error notifications in `prod` |

In `prod` and without an explicit transport, the mailer falls back to PHP's `mail()` function.
Configure a real transport before deploying.

## OAuth

| Variable | Notes |
| --- | --- |
| `GITHUB_CLIENT_ID`, `GITHUB_CLIENT_SECRET` | GitHub client, registered in `frontend/config/web.php` |
| `FACEBOOK_CLIENT_ID`, `FACEBOOK_CLIENT_SECRET` | Facebook client. The configuration reads both, but `.env.dist` does not ship them, so add the lines before enabling the client |

## Storage and images

| Variable | Notes |
| --- | --- |
| `GLIDE_SIGN_KEY` | Signing key for Glide image URLs |
| `GLIDE_MAX_IMAGE_SIZE` | Largest image Glide will process, in bytes |

## Cookie keys

`FRONTEND_COOKIE_VALIDATION_KEY` and `BACKEND_COOKIE_VALIDATION_KEY` sign the session cookies.
`.env.dist` ships the placeholders `<generated_key>`, and `php console/yii app/setup` replaces them
with random values through the `app/set-keys` action. Run it before the first request, otherwise
the applications answer with a cookie validation error.

## Docker on Windows

`COMPOSE_CONVERT_WINDOWS_PATHS=1` works around volume path conversion in Docker Toolbox. Keep it
when you use that environment.

## Applying changes

`.env` is read on every request, so most changes take effect immediately. Restart the containers
when a change affects a long-running process, for example the queue listener:

```bash
make down
make up
```

If you pointed the application at a new, empty database, create the schema with
`php console/yii app/setup`.
