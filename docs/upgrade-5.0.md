# Upgrading from 4.x to 5.0

5.0 is a major release: PHP 8.0 is end-of-life and is affected by
CVE-2026-109618 and CVE-2026-109619 (critical, unauthenticated remote code
execution). Upgrading PHP is the fix, so the minimum supported version is now
PHP 8.4.

## 1. PHP

- Require PHP 8.4.27+ or 8.5.12+ (or a distribution build with the CVE fixes
  backported).
- Update `composer.json`:

  ```json
  "require": {
      "php": "^8.4"
  }
  ```

- Run `composer update`.

If you deploy with Docker, pull the new images (`8.4-fpm-latest`). Note that the
plain `yiisoftware/yii2-php:8.4-fpm` tag can lag behind security releases; use
`8.4-fpm-latest`.

## 2. Dependencies

The following upgrades are required and involve code changes:

| Package | 4.x | 5.0 |
|---|---|---|
| `yiisoft/yii2` | 2.0.46 | ^2.0.55 |
| `yiisoft/yii2-authclient` | 2.2.13 | ^2.2.15 |
| `yiisoft/yii2-queue` | 2.3.4 | ^2.3.8 |
| `symfony/process` | ^4.0 | ^7.4 |
| `yii2-starter-kit/yii2-file-kit` | 2.1 | ^2.2 |
| `trntv/yii2-glide` | 1.2 | replaced by `yii-starter-kit/yii2-glide:^2.0` |
| `league/flysystem` | 1.x | 3.x |
| `intervention/image` | 2.x | 3.x |

### Glide

Replace the package and update the class namespaces:

- `trntv\glide\components\Glide` becomes `YiiStarterKit\glide\components\Glide`
- `trntv\glide\controllers\GlideController` becomes
  `YiiStarterKit\glide\controllers\GlideController`

Configuration keys (`sourcePath`, `cachePath`, `signKey`, `maxImageSize`,
`urlManager`) are unchanged.

### Flysystem 3

- `League\Flysystem\Adapter\Local` becomes
  `League\Flysystem\Local\LocalFilesystemAdapter`.
- `Filesystem::put()`, `get()`, `has()` and similar calls are now
  `write()`, `read()` and `fileExists()`. `readStream()` and `writeStream()`
  are available.
- `League\Flysystem\File` no longer exists. File metadata comes from the
  filesystem: `fileSize()`, `mimeType()`.
- `yii2-file-kit` events expose `filesystem` and `path`; the old `file`
  property is gone.

`yii2-file-kit` 2.2.0 still passes a `League\Flysystem\Config` object to
`writeStream()`. This release ships
`common/components/filesystem/Filesystem` to bridge that until upstream is
fixed. Keep it if you use `LocalFlysystemBuilder`.

### Intervention Image 3

- `ImageManagerStatic::make()` becomes `ImageManager::gd()->read()`.
- `fit()` becomes `cover()` (or `scale()` / `resize()` depending on intent).
- `encode()` returns an `EncodedImage`; cast it to string before writing.

## 3. Database

MySQL 8.4 removed the `skip-character-set-client-handshake` and
`default_authentication_plugin` options. Remove them from your MySQL
configuration. `caching_sha2_password` (the 8.4 default) is supported by PHP
mysqlnd.

## 4. Frontend build

- Node.js 24+ is required.
- The build moved from webpack 4 / Babel 6 to webpack 5 / Babel 7. Use
  `npm ci` instead of `npm install`, then `npm run build`.
- `url-loader` and `file-loader` were replaced by webpack asset modules.
- `package-lock.json` was regenerated. If you maintain your own lockfile,
  regenerate it from `package.json`.

## 5. Docker

- Use `docker compose` (Compose v2). The `version:` key is obsolete.
- Mailcatcher was replaced by Mailpit. The UI is available on
  `http://localhost:8025`, and `SMTP_HOST` is now `mailpit`.
- Service names used by `taskctl` and Composer scripts are `console` and
  `node`. Update any private scripts that still reference `app` or
  `webpacker`.

## 6. Tests

The test suite now follows Codeception 5 conventions:

- Suite files use `actor:` instead of `class_name:`.
- `bootstrap: _bootstrap.php` is a top-level setting.
- The Yii2 module requires `configFile` in every suite.
- Acceptance suites use `/<app>/web/index-test.php/site/index` as `homeUrl`
  so login redirects work with the built-in PHP server.

Run `vendor/bin/codecept build` after updating suite configuration.
