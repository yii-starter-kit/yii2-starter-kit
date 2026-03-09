# Yii2 Starter Kit — Agent Instructions

## Project Overview

This is an **advanced Yii2 starter kit** — a multi-application PHP project built on the Yii2 framework. It provides a production-ready foundation with backend CMS, public frontend, RESTful API, console commands, and file storage service.

## Architecture

The project follows Yii2's **advanced application template** pattern with five independent applications sharing a common library:

| Folder | Purpose | Namespace | URL |
|--------|---------|-----------|-----|
| `api/` | RESTful API with Swagger docs | `api\` | `api.yii2-starter-kit.localhost` |
| `backend/` | Admin dashboard (AdminLTE 3) | `backend\` | `backend.yii2-starter-kit.localhost` |
| `frontend/` | Public-facing website | `frontend\` | `yii2-starter-kit.localhost` |
| `console/` | CLI commands and migrations | `console\` | N/A |
| `storage/` | File storage microservice | `storage\` | `storage.yii2-starter-kit.localhost` |
| `common/` | Shared models, components, config | `common\` | N/A |

Each application has this internal structure:
```
{app}/
├── config/           # base.php, web.php, console.php, bootstrap.php, _urlManager.php
├── controllers/      # Request handlers
├── models/           # App-specific models (forms, search)
├── views/            # PHP templates (layouts + views)
├── modules/          # Feature modules (backend has most)
├── web/              # Public entry point and assets
├── runtime/          # Temporary files (logs, cache) — gitignored
├── Dockerfile        # Docker build
├── yii               # Console entry point (Linux)
└── yii.bat           # Console entry point (Windows)
```

## Namespace Conventions

PSR-4 autoloading is defined in `composer.json`:
```
common\              → common/
frontend\            → frontend/
backend\             → backend/
api\                 → api/
console\             → console/
storage\             → storage/
tests\               → tests/
```

Key sub-namespaces:
- `common\models\` — Shared ActiveRecord models (User, Article, Page, etc.)
- `common\models\query\` — Custom ActiveQuery classes (UserQuery, ArticleQuery)
- `common\components\` — Application components (filesystem, keyStorage, maintenance)
- `common\behaviors\` — Reusable behaviors (GlobalAccessBehavior, LocaleBehavior)
- `common\commands\` — Command Bus commands (SendEmailCommand, AddToTimelineCommand)
- `common\widgets\` — Reusable widgets (DbText, DbMenu, DbCarousel)
- `common\validators\` — Custom validators (JsonValidator)
- `common\actions\` — Reusable controller actions (SetLocaleAction)
- `common\rbac\` — RBAC base classes and rules
- `backend\modules\{name}\` — Backend feature modules (content, file, rbac, system, translation, widget)
- `frontend\modules\user\` — Frontend user authentication module
- `api\modules\v1\` — Versioned API module

## Configuration System

Each app loads configs via merge in this order:
1. `common/config/base.php` — Core shared components (DB, cache, auth, mailer, i18n)
2. `common/config/web.php` or `common/config/console.php` — Shared web/console config
3. `{app}/config/base.php` — App-specific components
4. `{app}/config/web.php` or `{app}/config/console.php` — App-specific web/console config

**Environment**: Uses `vlucas/phpdotenv` loaded in `common/env.php`. The `env()` helper (defined in `common/helpers.php`) reads environment variables. Copy `.env.dist` to `.env` for local development.

Key environment variables: `YII_DEBUG`, `YII_ENV`, `DB_DSN`, `DB_USERNAME`, `DB_PASSWORD`, `FRONTEND_HOST_INFO`, `BACKEND_HOST_INFO`, `API_HOST_INFO`, `STORAGE_HOST_INFO`, `FRONTEND_COOKIE_VALIDATION_KEY`, `GLIDE_SIGN_KEY`.

**Path aliases** (set in `common/config/bootstrap.php`): `@base`, `@common`, `@frontend`, `@backend`, `@api`, `@storage`, `@console`, `@frontendUrl`, `@backendUrl`, `@storageUrl`, `@apiUrl`.

## Model Patterns

### ActiveRecord Models (in `common/models/`)
- Extend `yii\db\ActiveRecord`
- Use status constants: `STATUS_ACTIVE`, `STATUS_DELETED`, `STATUS_DRAFT`, `STATUS_PUBLISHED`
- Attach behaviors: `TimestampBehavior`, `BlameableBehavior`, `SluggableBehavior`, `UploadBehavior`
- Override `find()` to return custom query class: `public static function find() { return new UserQuery(static::class); }`
- Table names use `{{%tablename}}` prefix notation

### Query Classes (in `common/models/query/`)
- Extend `yii\db\ActiveQuery`
- Provide chainable filter methods: `->active()`, `->published()`, `->notDeleted()`

### Search Models (in `backend/models/search/`)
- Extend the base ActiveRecord model (e.g., `UserSearch extends User`)
- Override `rules()` for search-specific validation
- Implement `search($params)` returning `ActiveDataProvider`

### Form Models (in `{app}/models/`)
- Extend `yii\base\Model`
- Used for login forms, account forms, contact forms
- Not ActiveRecord — purely validation and business logic

## Controller Patterns

- Extend `yii\web\Controller` (web) or `yii\rest\Controller` (API)
- Use `behaviors()` for access control, PageCache, VerbFilter
- Delegate reusable actions via `actions()` method
- API controllers return JSON via `$this->asJson()`
- Backend controllers use dynamic layouts based on auth state

## Module Patterns

Backend modules (in `backend/modules/`):
- `content` — Article and page management
- `file` — File manager (elFinder integration)
- `rbac` — Role and permission management
- `system` — System settings, logs, cache management
- `translation` — i18n translation management
- `widget` — Widget management (menu, carousel, text blocks)

Each module has: `Module.php` (entry), `controllers/`, `models/`, `views/`.

## Database & Migrations

- MySQL 8 (default, via Docker or local)
- DB migrations in `common/migrations/db/` — run via `php console/yii migrate/up`
- RBAC migrations in `common/migrations/rbac/` — run via `php console/yii rbac-migrate/up`
- Migration naming: `m{YYMMDD}_{HHMMSS}_{description}.php`
- DB migrations extend `yii\db\Migration` with `safeUp()`/`safeDown()`
- RBAC migrations extend `common\rbac\Migration`

## Authentication & Authorization

- `common\models\User` implements `yii\web\IdentityInterface`
- Roles: `ROLE_USER`, `ROLE_MANAGER`, `ROLE_ADMINISTRATOR`
- RBAC via `yii\rbac\DbManager`
- `common\behaviors\GlobalAccessBehavior` enforces access rules on controllers
- Permissions managed through RBAC migrations and backend module

## Frontend Assets

- Webpack bundles JS and LESS → `{app}/web/bundle/`
- Build: `npm run build` (production), `npm run dev` (development), `npm run watch` (watch mode)
- Asset bundles registered via Yii2 `AssetBundle` classes (`BackendAsset`, etc.)
- Backend uses AdminLTE 3, Bootstrap 4
- Frontend uses Bootstrap 4

## Docker Development

Services defined in `docker-compose.yml`:
- `frontend`, `backend`, `api`, `storage`, `console` — PHP 8.0 FPM containers
- `nginx` — Reverse proxy (port 80), routes by hostname
- `db` — MySQL 8 (port 3306)
- `mailcatcher` — Email testing (port 1080)
- `node` — Node.js 18 for asset compilation

Quick start: `make docker-build` (or `composer docker:build`)

## Testing

- Framework: **Codeception 5** with Yii2 module
- Test suites per app: `tests/backend/`, `tests/frontend/`, `tests/api/`, `tests/console/`, `tests/common/`
- Each suite has: `unit/`, `functional/`, `acceptance/`
- Config: `codeception.yml` (root), per-suite YAML configs
- Run tests: `vendor/bin/codecept run` (all) or `vendor/bin/codecept run backend` (single app)
- Test DB: `yii2-starter-kit-test` (created separately)

## Key Commands

| Command | Purpose |
|---------|---------|
| `make docker-build` | Full Docker setup (build, install deps, migrate, build assets) |
| `make docker-start` / `make docker-stop` | Start/stop containers |
| `make docker-tests-run` | Run test suite in Docker |
| `make local-build` | Non-Docker local setup |
| `php console/yii app/setup` | Run full application setup (migrations, keys, permissions) |
| `php console/yii migrate/up` | Run database migrations |
| `php console/yii rbac-migrate/up` | Run RBAC permission migrations |
| `npm run build` | Build frontend assets for production |
| `vendor/bin/codecept run` | Run all tests |

## Coding Conventions

- **PHP version**: 8.0+
- **Class naming**: PascalCase — `UserController`, `ArticleQuery`, `LoginTimestampBehavior`
- **File naming**: Match class name — `UserController.php`, `ArticleQuery.php`
- **Config files**: lowercase, underscore-prefixed partials — `base.php`, `web.php`, `_urlManager.php`
- **Table names**: Use `{{%tablename}}` for table prefix support
- **Constants**: ALL_CAPS for status/role constants defined as class constants
- **Views**: PHP templates using `$this->beginContent()` / `$this->endContent()` for layout inheritance
- **i18n**: Use `Yii::t('app', 'message')` for translatable strings; sources in `common/messages/`

## Important Files

- `common/env.php` — Environment bootstrap (loads `.env`, defines `YII_DEBUG`/`YII_ENV`)
- `common/helpers.php` — Global helper functions (`env()`, `getMyId()`)
- `common/config/bootstrap.php` — Path alias definitions
- `common/config/base.php` — Core component configuration (DB, cache, mailer, RBAC, etc.)
- `.env.dist` — Environment variable template
- `docker-compose.yml` — Docker service definitions
- `Makefile` — Build and management commands
