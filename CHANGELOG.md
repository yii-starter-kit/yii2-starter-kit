# Changelog

All notable changes to this project are documented in this file.

The format is based on [Keep a Changelog](https://keepachangelog.com/en/1.1.0/),
and this project adheres to [Semantic Versioning](https://semver.org/spec/v2.0.0.html).

## [5.0.1] - 2026-10-22

### Added

- `SECURITY.md`, with private vulnerability reporting enabled so a report does
  not have to start as a public issue.
- `.editorconfig`, and a `packageManager` pin so npm uses the version the
  lockfile was generated with.
- CI now runs `composer validate --strict` and `composer audit --locked`, so an
  unbound constraint or a new advisory fails the build instead of shipping.

### Changed

- Patch-level dependency updates: `yiisoft/yii2-debug` 2.1.28,
  `yiisoft/yii2-bootstrap4` 2.0.12, `yiisoft/yii2-gii` 2.2.7,
  `vlucas/phpdotenv` 5.7.0 and `yii-starter-kit/sitemaped` 2.0.2.
- `yiisoft/yii2-debug` moved to `require-dev`. It is only loaded when
  `YII_DEBUG` is on, so production installs no longer ship the debugger.
- `asofter/yii2-imperavi-redactor` is pinned to `dev-master` instead of the
  unbound `>=0.0.3@dev`, which lets `composer validate --strict` pass.
- `axllent/mailpit` is pinned to `v1.31.6` instead of `latest`, and
  `node_modules` / `vendor` are excluded from the Docker build context.

### Fixed

- Runtime PHP settings now actually reach the containers. The old
  `docker/php/php.ini` was only consumed by `docker/php/Dockerfile`, which
  `docker-compose.yml` never built, so most of its values were inert. It also
  duplicated the base image's `conf.d/base.ini`, which already sets the
  timezone, `expose_php`, `cgi.fix_pathinfo`, the `upload_progress` mitigation
  for CVE-2026-109619 and a tuned OPcache block.
- Uploads are no longer capped at the image default of 60M. `memory_limit`,
  `upload_max_filesize` and `post_max_size` are raised together so the
  CVE-2026-109618 invariant still holds: a request body stays below
  `memory_limit`.
- nginx no longer refuses to start with `host not found in upstream` while a
  PHP container is being recreated. Upstreams are resolved through Docker's
  embedded DNS at request time, so a missing backend answers 502 until it comes
  back instead of putting nginx into a restart loop.
- The `db` service has a health check and the application containers wait for
  it, so Yii no longer boots against a MySQL server that is still starting.

### Removed

- `docker/php/Dockerfile`, `docker/php/php.ini`, `docker/php/www.conf` and
  `docker/php/install-composer.sh`. The custom image was never referenced by
  `docker-compose.yml`, and everything it added (Composer, OPcache, Xdebug, gd,
  intl, zip, pdo_mysql) already ships in `yiisoftware/yii2-php:8.4-fpm-latest`.

## [5.0.0] - 2026-10-22

### Security

- **PHP 8.4 is now required.** PHP 8.0 reached end of life in August 2023 and
  cannot receive fixes for CVE-2026-109618 and CVE-2026-109619 (critical,
  unauthenticated remote code execution). The runtime is now PHP 8.4.27 or
  8.5.12 and newer.
- Updated `yiisoft/yii2` to 2.0.55, `yiisoft/yii2-authclient` to 2.2.19,
  `yiisoft/yii2-queue` to 2.3.8 and `symfony/process` to 7.4, clearing all
  Composer security advisories (`composer audit` reports none).
- Replaced the abandoned `trntv/yii2-glide` with the maintained
  `yii-starter-kit/yii2-glide` 2.0, which upgrades Flysystem to 3, Glide to 3
  and Intervention Image to 3.
- Updated `studio-42/elfinder` to 2.1.70.
- Replaced the unmaintained Mailcatcher with Mailpit.
- Rebuilt the frontend toolchain on webpack 5 and Babel 7. `npm audit` went
  from 114 vulnerabilities (31 critical) to zero.

### Added

- CI matrix for PHP 8.4 and 8.5 with MySQL 8.4.
- A `Frontend assets` CI job that runs `npm ci`, `npm audit --audit-level=high`
  and `npm run build` on Node 24.
- `docker/php/php-app.ini`, applied to every application container, which
  disables `display_errors` and excludes deprecation notices from output.
- `common/components/filesystem/Filesystem`, a compatibility shim for
  `yii2-file-kit` 2.2.0 until it adopts the Flysystem 3 `writeStream()` array
  signature.
- `docs/upgrade-5.0.md`, a migration guide for 4.x projects.

### Changed

- Minimum PHP version is `^8.4` (previously `>=7.4 || ^8.0`).
- Docker base images use `yiisoftware/yii2-php:8.4-fpm-latest`, MySQL 8.4 and
  Node 24.
- `docker/mysql/config.cnf` no longer uses options removed in MySQL 8.4.
- Glide, Flysystem and Intervention Image integrations were migrated to their
  current major versions.
- All Docker tooling now uses `docker compose` (Compose v2). The stale `app`
  and `webpacker` service names in `taskctl.yaml` were corrected to `console`
  and `node`.
- `npm install` was replaced by `npm ci` in automation and documentation.
- Mailpit UI is exposed on port 8025, and `SMTP_HOST` defaults to `mailpit`.

### Removed

- Support for PHP 7.4, 8.0, 8.1, 8.2 and 8.3.
- `trntv/yii2-glide`, Mailcatcher, webpack 4, Babel 6, `url-loader`,
  `file-loader`, `uglifyjs-webpack-plugin` and
  `optimize-css-assets-webpack-plugin`.

### Fixed

- PHP 8.4 deprecation notices from legacy dependencies no longer leak into
  HTTP responses and break headers.
- MySQL 8.4 startup no longer fails on removed server options.
- The Codeception 5 test harness now generates actors and loads bootstrap files
  correctly (`actor`, top-level `bootstrap`, per-suite `configFile`).
- Acceptance suites: the post-login redirect resolves to a real route, and the
  duplicated `on missingTranslation` handler no longer crashes the error page.
- `package-lock.json` was regenerated. The committed file contained duplicate
  `dependencies` keys and invalid JSON, which made `npm ci` impossible.
