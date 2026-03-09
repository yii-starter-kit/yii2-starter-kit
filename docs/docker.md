# Docker & `ysk` CLI

`ysk` is a thin shell script (inspired by Laravel Sail) that wraps `docker compose` commands so you never have to remember container names, service flags, or compose file paths.

The script lives at `console/ysk` and can be run from anywhere in the project:

```bash
./console/ysk <command> [arguments]
```

> **Tip:** Add the project root to your `$PATH`, or create an alias — `alias ysk='./console/ysk'`.

---

## TABLE OF CONTENTS
- [Docker \& `ysk` CLI](#docker--ysk-cli)
  - [TABLE OF CONTENTS](#table-of-contents)
  - [Quick start](#quick-start)
  - [Lifecycle](#lifecycle)
  - [PHP / Application](#php--application)
  - [Frontend / Assets](#frontend--assets)
  - [Database](#database)
  - [Testing](#testing)
  - [Shell access](#shell-access)
  - [Maintenance](#maintenance)
    - [Xdebug](#xdebug)
    - [Clean up](#clean-up)
  - [Available services](#available-services)
    - [DB credentials (defaults)](#db-credentials-defaults)
  - [Troubleshooting](#troubleshooting)
    - [Browser shows the default nginx welcome page instead of the app](#browser-shows-the-default-nginx-welcome-page-instead-of-the-app)
    - [PHP-FPM container exits immediately](#php-fpm-container-exits-immediately)
    - [`./console/ysk yii` says "containers are not running"](#consoleysk-yii-says-containers-are-not-running)
    - [Port already in use on startup](#port-already-in-use-on-startup)

---

## Quick start

```bash
# 1. Copy environment config
cp .env.dist .env          # adjust DB credentials, app URLs, etc.

# 2. Build images and start all containers
./console/ysk up --build

# 3. Install PHP and Node dependencies (inside containers — no local PHP/Node needed)
./console/ysk install

# 4. Run migrations, generate cookie keys, set directory permissions
./console/ysk setup
```

Your app is now available at:

| Service   | URL                                          |
|-----------|----------------------------------------------|
| Frontend  | http://yii2-starter-kit.localhost            |
| Backend   | http://backend.yii2-starter-kit.localhost    |
| API       | http://api.yii2-starter-kit.localhost        |
| Storage   | http://storage.yii2-starter-kit.localhost    |
| Mail UI   | http://localhost:1080                        |

---

## Lifecycle

| Command | Description |
|---------|-------------|
| `./console/ysk up` | Start all services in the background |
| `./console/ysk up --build` | Rebuild images, then start |
| `./console/ysk down` | Stop and remove containers |
| `./console/ysk restart` | Restart all containers |
| `./console/ysk build` | Build images without starting |
| `./console/ysk ps` | Show container statuses |
| `./console/ysk logs` | Tail logs for all services |
| `./console/ysk logs nginx` | Tail logs for a specific service |

---

## PHP / Application

| Command | Description |
|---------|-------------|
| `./console/ysk install` | Install Composer + npm dependencies inside containers |
| `./console/ysk composer <args>` | Run any Composer command |
| `./console/ysk php <args>` | Run php in the console container |
| `./console/ysk yii <cmd>` | Run a Yii2 console command |
| `./console/ysk setup` | Run `app/setup` (migrations + keys + permissions) |
| `./console/ysk migrate` | Run pending DB migrations |
| `./console/ysk migrate --fresh` | Drop all tables and re-run all migrations |

**Examples:**

```bash
./console/ysk yii migrate/up
./console/ysk yii cache/flush-all
./console/ysk yii rbac-migrate/up
./console/ysk composer require yiisoft/yii2-redis
./console/ysk php -i | grep xdebug
```

---

## Frontend / Assets

| Command | Description |
|---------|-------------|
| `./console/ysk npm <args>` | Run any npm command in the node container |
| `./console/ysk build-assets` | Build frontend assets for production |
| `./console/ysk watch-assets` | Watch source files and rebuild on change |

**Examples:**

```bash
./console/ysk npm run dev
./console/ysk build-assets
./console/ysk watch-assets   # Ctrl-C to stop
```

---

## Database

| Command | Description |
|---------|-------------|
| `./console/ysk mysql` | Open an interactive MySQL shell |
| `./console/ysk mysql-dump` | Dump DB to a timestamped `.sql` file in the project root |
| `./console/ysk mysql-dump backup.sql` | Dump to a named file |
| `./console/ysk mysql-import backup.sql` | Import a `.sql` file into the database |

**Examples:**

```bash
./console/ysk mysql
./console/ysk mysql-dump                  # → dump_20260309_143000.sql
./console/ysk mysql-dump before-migration.sql
./console/ysk mysql-import before-migration.sql
```

MySQL is also reachable from your host at `localhost:3306`.

---

## Testing

| Command | Description |
|---------|-------------|
| `./console/ysk test` | Run the full Codeception test suite |
| `./console/ysk test backend` | Run a single suite |
| `./console/ysk test backend unit` | Run a suite + group |
| `./console/ysk test-build` | Rebuild Codeception suite definitions |

**Example:**

```bash
./console/ysk test-build
./console/ysk test
./console/ysk test frontend functional
```

---

## Shell access

| Command | Description |
|---------|-------------|
| `./console/ysk shell` | Open bash in the `console` container |
| `./console/ysk shell backend` | Open bash in a specific service container |
| `./console/ysk root` | Open bash as root in the `console` container |
| `./console/ysk root nginx` | Open bash as root in the `nginx` container |

---

## Maintenance

### Xdebug

Xdebug is installed but **disabled by default** (`xdebug.mode=off`). Toggle it at runtime without rebuilding containers:

```bash
./console/ysk xdebug on    # sets XDEBUG_MODE=debug and restarts PHP services
./console/ysk xdebug off
```

Configure your IDE to listen on port `9003` with idekey `PHPSTORM`.

### Clean up

```bash
./console/ysk clean   # removes all containers and volumes (prompts for confirmation)
```

---

## Available services

| Service | Container | Notes |
|---------|-----------|-------|
| `frontend` | PHP-FPM | Public website |
| `backend` | PHP-FPM | Admin panel |
| `api` | PHP-FPM | REST API |
| `console` | PHP-FPM | Migrations, queue, yii CLI |
| `storage` | PHP-FPM | File storage microservice |
| `nginx` | nginx stable-alpine | Reverse proxy, port 80 |
| `db` | MySQL 8 | Port 3306, with healthcheck |
| `node` | Node 18 alpine | Asset compilation (ephemeral) |
| `mailcatcher` | Mailpit | SMTP port 1025, web UI port 1080 |

### DB credentials (defaults)

| Variable | Default |
|----------|---------|
| `DB_ROOT_PASSWORD` | `root` |
| `DB_NAME` | `yii2-starter-kit` |
| `DB_USERNAME` | `ysk_dbu` |
| `DB_PASSWORD` | `ysk_pass` |

Override any of these in your `.env` file before starting containers.

---

## Troubleshooting

### Browser shows the default nginx welcome page instead of the app

A host-level service (e.g. a locally installed nginx, Apache, or another web server) is already bound to port 80 and is intercepting the request before Docker gets it. Stop the conflicting service first:

```bash
# Ubuntu / Debian
sudo service nginx stop
sudo service apache2 stop

# Check what is holding port 80
sudo ss -tlnp | grep ':80'
```

The same applies to MySQL on port 3306 — if a host MySQL is running, the DB container's port mapping may conflict:

```bash
sudo service mysql stop
```

After stopping the conflicting services, your Docker containers will handle those ports exclusively.

### PHP-FPM container exits immediately

The most common cause is a missing or invalid `php.ini` / `www.conf` being copied into the image. Check the build output:

```bash
./console/ysk build 2>&1 | tail -30
./console/ysk logs frontend
```

### `./console/ysk yii` says "containers are not running"

Start the stack first:

```bash
./console/ysk up
```

### Port already in use on startup

If `./console/ysk up` fails with "port is already allocated", identify and stop the process holding the port:

```bash
sudo ss -tlnp | grep ':80\|:3306'
```
