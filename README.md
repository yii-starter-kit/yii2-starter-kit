# Yii 2 Starter Kit

[![Packagist Version](https://img.shields.io/packagist/v/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![Packagist Downloads](https://img.shields.io/packagist/dt/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![Build](https://github.com/yii-starter-kit/yii2-starter-kit/actions/workflows/main.yml/badge.svg?branch=main)](https://github.com/yii-starter-kit/yii2-starter-kit/actions/workflows/main.yml)

An application template for building advanced websites on Yii 2. It ships the parts most projects
rebuild from scratch: authentication with RBAC, a content-managed backend, a REST API,
internationalisation, file storage and a Docker development stack.

It is aimed at developers. The result is a starting point for your own application, not a
finished product.

## Requirements

| Requirement | Version | Needed for |
| --- | --- | --- |
| PHP | 8.4 or newer | The application. `ext-intl` and `ext-gd` are declared in `composer.json`; `pdo_mysql`, `fileinfo` and `zip` are required at runtime |
| MySQL | 8.4 or newer | The application and the test suite |
| Node.js | 24 or newer | Asset builds |
| Composer | 2.x | Creating and updating the project |
| Docker with Compose v2 | Current release | The recommended route: the containers provide PHP, Node and MySQL |
| taskctl | Optional | An alternative to `make` |

The Docker route needs only Docker and Composer on the host, because `make build` installs the PHP
and Node dependencies inside the containers. The manual route in
[docs/installation.md](docs/installation.md) needs everything in the table.

## Quickstart

1. Install [Docker](https://docs.docker.com/get-started/get-docker/) with Compose v2.
2. Create the project:

    ```bash
    composer create-project yii2-starter-kit/yii2-starter-kit myproject.com
    cd myproject.com
    ```

3. Create the environment file and start the stack:

    ```bash
    make env     # write .env from .env.dist
    make build   # start the containers, migrate, build assets
    ```

4. Open [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost). If your system
   does not resolve `*.localhost`, add the four host names to `/etc/hosts` as described in
   [the installation guide](docs/installation.md#hostnames).

The same stack answers on [http://backend.yii2-starter-kit.localhost](http://backend.yii2-starter-kit.localhost)
for the backend, on [http://api.yii2-starter-kit.localhost](http://api.yii2-starter-kit.localhost)
for the API and its Swagger UI, and on [http://localhost:8025](http://localhost:8025) for Mailpit.

`make` is the maintained entry point. Run `make help` to list every target, and `make install` to
put the Composer and npm packages on the host as well, which you need for IDE autocompletion and
for `make test-local`. If you use another runner, the `taskctl` pipelines (`taskctl install`,
`taskctl start`) and the Composer scripts (`composer run-script docker:build`) do the same work.

## Documentation

### Guides

- [Installation](docs/installation.md)
- [Configuration](docs/configuration.md)
- [Components](docs/components.md)
- [Console commands](docs/console.md)
- [Testing](docs/testing.md)
- [FAQ](docs/faq.md)

### Project

- [Contributing](CONTRIBUTING.md)
- [Development workflow](docs/development-workflow.md)
- [Changelog](CHANGELOG.md)
- [Upgrading from 4.x](docs/upgrade-5.0.md)
- [Security policy](SECURITY.md)

## Features

### Backend
- [AdminLTE 3](https://adminlte.io/themes/v3/) dashboard theme
- Content management: articles, categories, static pages, menus, carousels and text blocks
- Settings editor backed by the key-value storage component
- [File manager](https://github.com/MihailDev/yii2-elfinder) and file storage
- Users and RBAC management
- Events timeline
- Log viewer and system information
- Translation manager

### Development
- Docker stack with PHP, nginx, MySQL 8.4, Mailpit and Node
- `.env` configuration
- [Webpack](https://webpack.js.org/) asset build
- REST API module with a [Swagger](https://swagger.io/) UI
- Queue component ([yiisoft/yii2-queue](https://github.com/yiisoft/yii2-queue))
- Command bus with queued and asynchronous tasks ([trntv/yii2-command-bus](https://github.com/trntv/yii2-command-bus))
- Key-value storage, [file uploads](https://github.com/yii-starter-kit/yii2-file-kit) and on-demand
  thumbnails ([yii-starter-kit/yii2-glide](https://github.com/yii-starter-kit/yii2-glide))
- Sitemap generator
- Extended IDE autocompletion
- Codeception suites for the `api`, `backend`, `common`, `console` and `frontend` applications

### Internationalisation
- Shipped locales: `es`, `fr`, `hu`, `id`, `pl`, `pt-BR`, `ru`, `uk`, `vi` and `zh`, plus English
- Language switcher and locale detection from the browser
- Backend translation manager

### Users
- Sign in, sign up, and profile editing with avatar, locale and personal data
- Optional activation by email
- OAuth sign in
- RBAC with the predefined `guest`, `user`, `manager` and `administrator` roles
- RBAC migrations

### Widgets and behaviours
- [WYSIWYG Redactor widget](https://github.com/asofter/yii2-imperavi-redactor),
  [date and time picker](https://github.com/trntv/yii2-bootstrap-datetimepicker),
  [Ace editor](https://github.com/trntv/yii2-aceeditor) and
  [Xhprof debug panel](https://github.com/trntv/yii2-debug-xhprof)
- `GlobalAccessBehavior` and `CacheInvalidateBehavior`
- Maintenance mode support ([details](docs/components.md#maintenance-mode))

## Default accounts

The seed migration creates three accounts, one per role. The credentials and the role each one
holds are listed in [docs/installation.md](docs/installation.md#default-accounts). Change them
before deploying.

## Contributing

Contributions of every kind are welcome, documentation included. [CONTRIBUTING.md](CONTRIBUTING.md)
covers local setup and the checks a pull request has to pass.
[docs/development-workflow.md](docs/development-workflow.md) explains branches,
[Conventional Commits](https://www.conventionalcommits.org) and the release flow.

```bash
make hooks      # enable the commit-msg hook, once per clone
make up         # start the Docker stack
make verify     # everything a pull request has to pass
```

## Questions

Open an [issue](https://github.com/yii-starter-kit/yii2-starter-kit/issues) or write to
[victor@vgr.cl](mailto:victor@vgr.cl), the current maintainer.

## Licence

Released under the BSD-3-Clause licence. See [LICENSE.md](LICENSE.md).

## See also

- [Yii 2 guide](https://github.com/yiisoft/yii2/blob/master/docs/guide/README.md)
- [Docker documentation](https://docs.docker.com/get-started/)

## Stand with Ukraine 🇺🇦

This starter kit began as the work of [Yevhen Terentiev](https://github.com/trntv), who is
Ukrainian. In March 2022, days after Russia launched its full-scale invasion, he added the note
quoted below. The project keeps that position: the war is a crime, and staying silent about it is
not neutrality. Companies, organizations and individuals who profit from the war, or who look
away while it happens, are not welcome to use this package.

Everyone else is welcome here, and there are concrete ways to help:

- [UNITED24](https://u24.gov.ua/donate): the official Ukrainian platform for defence, medical,
  humanitarian and rebuilding projects.
- [Ukrainian Red Cross](https://redcross.org.ua/en/donate/): humanitarian aid for civilians
  inside Ukraine.
- [Razom for Ukraine](https://www.razomforukraine.org/): a US non-profit funding medical and
  civil defence supplies, with tax-deductible donations.

Sharing verified reporting about war crimes, and asking your representatives to support Ukraine,
costs nothing and matters just as much. Thank you for taking the time.

> While Russia is destroying my home and my country, killing my friends and neighbors - any
> russian company, organization, or citizen, who do nothing about it, is prohibited from using
> this package.
> For others - please, pray for us, share information about war crimes Russia is conducting in
> Ukraine, do everything you can to urge your governments to be on the right side of history.
> Ukraine will prevail! Good triumph over evil! Русский военный корабль, иди нах#й!

