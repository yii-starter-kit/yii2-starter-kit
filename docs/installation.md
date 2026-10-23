# Installation

This page covers both routes: the Docker stack, which is what the project is developed and tested
on, and a manual installation on a web server you manage. Runtime settings are documented in
[configuration.md](configuration.md).

## Requirements

| Requirement | Notes |
| --- | --- |
| PHP 8.4 or newer | `ext-intl` and `ext-gd` are declared in `composer.json`; `pdo_mysql`, `fileinfo` and `zip` are required at runtime |
| MySQL 8.4 or newer | The test suite uses a second database on the same server |
| Node.js 24 or newer | Asset builds |
| Composer 2 | Creating and updating the project |
| Docker with Compose v2 | Only for the Docker route |

If you use [taskctl](https://github.com/taskctl/taskctl) instead of `make`, the pipelines in
`taskctl.yaml` do the same work.

## Docker installation

1. Install Docker with Compose v2.
2. Create the project:

    ```bash
    composer create-project yii2-starter-kit/yii2-starter-kit myproject.com
    cd myproject.com
    ```

    Cloning the repository works as well.

3. Create the environment file and start everything:

    ```bash
    make env     # write .env from .env.dist
    make build   # start the containers, run migrations, build assets
    ```

4. Open [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost).

The stack publishes these endpoints:

| Service | URL or address | Notes |
| --- | --- | --- |
| frontend | http://yii2-starter-kit.localhost | |
| backend | http://backend.yii2-starter-kit.localhost | |
| api | http://api.yii2-starter-kit.localhost | Swagger UI at the root |
| storage | http://storage.yii2-starter-kit.localhost | Signed Glide image URLs, served under `/cache/...` |
| Mailpit | http://localhost:8025 | Catches every message the application sends |
| MySQL | `127.0.0.1:3306` | Database `yii2-starter-kit`, application user `ysk_dbu` / `ysk_pass`, root user `root` / `root` |

Useful commands:

```bash
make logs                             # follow the container logs
make down                             # stop the stack, which also discards the database
make build                            # recreate the schema and rebuild assets
docker compose exec console bash      # shell inside the console container
docker compose exec console php console/yii help
```

Console commands run with `docker compose exec console php console/yii <command>`. See
[console.md](console.md) for the full list.

### Hostnames

The stack answers on four `*.localhost` names. Many systems resolve them to `127.0.0.1` without
configuration. If `getent hosts yii2-starter-kit.localhost` prints nothing, add them to
`/etc/hosts`:

```text
127.0.0.1 yii2-starter-kit.localhost backend.yii2-starter-kit.localhost api.yii2-starter-kit.localhost storage.yii2-starter-kit.localhost
```

### Database data

MySQL keeps its data in an anonymous volume mounted at `/var/lib/mysql`. `make down` removes the
container, and the next `make up` starts MySQL on a new, empty volume, so the schema and your data
are gone. Run `make build` to create the schema again.

The old volume is not deleted, it is only left unreferenced, so repeated down and up cycles
accumulate volumes. `docker volume prune` removes the ones no container uses, together with their
data. This is also how you start from a clean database.

## Manual installation

Use this route when the application has to run without Docker, for example on a shared host.

1. Install the PHP and Node dependencies:

    ```bash
    composer install
    npm ci
    ```

2. Create the environment file:

    ```bash
    make env
    ```

3. Edit `.env`. At minimum set `DB_DSN`, `DB_USERNAME` and `DB_PASSWORD`, and keep the host names
   in `*_HOST_INFO` in sync with the domains your web server answers on. Every variable is listed
   in [configuration.md](configuration.md).

4. Prepare the application. This writes the cookie validation keys, makes the `runtime` and `web`
   directories writable, runs the database and RBAC migrations, and seeds the default accounts:

    ```bash
    php console/yii app/setup
    ```

5. Build the frontend assets:

    ```bash
    npm run build
    ```

6. Point your web server at the four document roots: `frontend/web`, `backend/web`, `api/web` and
   `storage/web`.

### Web server configuration

`docker/nginx/vhost.conf` is written for the Docker stack: it resolves upstreams through Docker's
embedded DNS and uses compose service names. Adapt these lines before using it elsewhere:

- remove `resolver 127.0.0.11`;
- replace `fastcgi_pass $<name>_upstream` with your PHP-FPM socket, for example
  `fastcgi_pass unix:/run/php/php8.4-fpm.sock;`;
- point `root` at your checkout instead of `/app`.

## Single domain installation

The default setup uses one subdomain per application. To serve everything from one host, change the
URL pairs in `.env`. `.env.dist` already contains this block, commented out:

```ini
FRONTEND_HOST_INFO=http://yii2-starter-kit.localhost
FRONTEND_BASE_URL=/
BACKEND_HOST_INFO=http://yii2-starter-kit.localhost
BACKEND_BASE_URL=/backend/web
STORAGE_HOST_INFO=http://yii2-starter-kit.localhost
STORAGE_BASE_URL=/storage/web
```

Restart the containers after saving (`make down` then `make up`). The applications are then
reachable at `/`, `/backend/web` and `/storage/web` on the same host.

Then adjust the web server. `docker/nginx/vhost_single_domain.conf` shows the shape of that
configuration, with three caveats:

- it is Docker-oriented (`root /app`), so point `root` at your checkout;
- its `fastcgi_pass php-fpm` upstream still names the retired `app` service, so replace it with
  your PHP-FPM socket or the `console` service;
- it does not serve the API. If you need the API on the same host, set `API_HOST_INFO` to that host
  with an `API_BASE_URL` prefix and add the matching location block.

## Demo data

`app/demo-data` inserts random categories and articles, which is handy for a first look at the
frontend:

```bash
php console/yii app/demo-data 50
```

The argument is the number of categories and of articles, and it defaults to `10`. In Docker:

```bash
docker compose exec console php console/yii app/demo-data 50
```

## Default accounts

The seed migration `common/migrations/db/m150725_192740_seed_data.php` creates three accounts:

| Username | Password | Role |
| --- | --- | --- |
| `webmaster` | `webmaster` | `administrator` |
| `manager` | `manager` | `manager` |
| `user` | `user` | `user` |

Change or delete them before deploying to production.

