# Yii 2 Starter Kit

<!-- BADGES/ -->

[![Packagist](https://img.shields.io/packagist/v/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![Packagist](https://img.shields.io/packagist/dt/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![build](https://github.com/yii-starter-kit/yii2-starter-kit/actions/workflows/main.yml/badge.svg?branch=main)](https://github.com/yii-starter-kit/yii2-starter-kit/actions/workflows/main.yml)

<!-- /BADGES -->

# Stand with Ukraine!

---
<p align="center">
   <img align="center" src="https://github.blog/wp-content/uploads/2022/03/1200x630-GitHub-1.png?resize=320%2C240">
</p>

While Russia is destroying my home and my country, killing my friends and neighbors - any russian company, organization, or citizen, who do nothing about it,
is prohibited from using this package.
For others - please, pray for us, share information about war crimes Russia is conducting in Ukraine, do everything you can
to urge your governments to be on the right side of history.
Ukraine will prevail! Good triumph over evil! Русский военный корабль, иди нах#й!

---
This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2.

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

## Before you start
Requires **PHP 8.4+**, **MySQL 8.4+** and **Node.js 24+** (asset builds).
Please, consider helping project via [contributions](https://github.com/yii2-starter-kit/yii2-starter-kit/issues) or [donations](#donations).

## TABLE OF CONTENTS
- [Features](#features)
- [Installation](docs/installation.md)
    - [Manual installation](docs/installation.md#manual-installation)
    - [Docker installation](docs/installation.md#docker-installation)
- [Components documentation](docs/components.md)
- [Console commands](docs/console.md)
- [Testing](docs/testing.md)
- [Development workflow](docs/development-workflow.md)
- [FAQ](docs/faq.md)
- [How to contribute?](#how-to-contribute)
- [Have any questions?](#have-any-questions)

## Quickstart
1. [Install taskctl](https://github.com/taskctl/taskctl)
2. [Install Docker](https://docs.docker.com/get-docker/) (Compose v2 is included)
3. Run
    ```bash
    composer create-project yii2-starter-kit/yii2-starter-kit myproject.com
    cd myproject.com
    taskctl start
    ```
4. Go to [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost)

## FEATURES
### Admin backend
- Beautiful and open source dashboard theme for backend [AdminLTE 3](https://adminlte.io/themes/v3/)
- Content management components: articles, categories, static pages, editable menu, editable carousels, text blocks
- Settings editor. Application settings form (based on KeyStorage component)
- [File manager](https://github.com/MihailDev/yii2-elfinder)
- Users, RBAC management
- Events timeline
- Logs viewer
- System monitoring

### Development tasks
To list all available development tasks follow these steps:
1. Install [taskctl](https://github.com/taskctl/taskctl) task runner
2. Run ``taskctl``

### I18N
- Built-in translations:
    - English
    - Spanish
    - Russian
    - Ukrainian
    - Chinese
    - Vietnamese
    - Polish
    - Portuguese (Brazil)
    - Indonesian (Bahasa)
- Language switcher, built-in behavior to choose locale based on browser preferred language
- Backend translations manager

### Users
- Sign in
- Sign up
- Profile editing(avatar, locale, personal data)
- Optional activation by email
- OAuth authorization
- RBAC with predefined `guest`, `user`, `manager` and `administrator` roles
- RBAC migrations support

### Development
- Ready-to-use Docker-based stack (php, nginx, mysql, Mailpit)
- .env support
- [Webpack](https://webpack.js.org/) build configuration
- Key-value storage service
- Ready to use REST API module
- [File storage component + file upload widget](https://github.com/trntv/yii2-file-kit)
- On-demand thumbnail creation [yii-starter-kit/yii2-glide](https://github.com/yii-starter-kit/yii2-glide)
- Built-in queue component [yiisoft/yii2-queue](https://github.com/yiisoft/yii2-queue)
- Command Bus with queued and async tasks support [trntv/yii2-command-bus](https://github.com/trntv/yii2-command-bus)
- `ExtendedMessageController` with ability to replace source code language and migrate messages between message sources
- [Some useful shortcuts](https://github.com/yii2-starter-kit/yii2-starter-kit/blob/main/common/helpers.php)

### Other
- Useful behaviors (GlobalAccessBehavior, CacheInvalidateBehavior)
- Maintenance mode support ([more](#maintenance-mode))
- [Aceeditor widget](https://github.com/trntv/yii2-aceeditor)
- [Datetimepicker widget](https://github.com/trntv/yii2-bootstrap-datetimepicker),
- [Imperavi Reactor Widget](https://github.com/asofter/yii2-imperavi-redactor),
- [Xhprof Debug panel](https://github.com/trntv/yii2-debug-xhprof)
- Sitemap generator
- Extended IDE autocompletion
- Test-ready
- Docker support
- Built-in [Mailpit](https://mailpit.axllent.org/)
- [Swagger](https://swagger.io/) for API docs.

## Default accounts

The setup command seeds these accounts:

`administrator` role account
```
Login: webmaster
Password: webmaster
```

`manager` role account
```
Login: manager
Password: manager
```

`user` role account
```
Login: user
Password: user
```

## How to contribute?
You can contribute in any way you want. Any help appreciated, but most of all i need help with docs (^_^)

The workflow is described in [docs/development-workflow.md](docs/development-workflow.md): branch from
`main`, write [Conventional Commits](https://www.conventionalcommits.org), and open a
pull request. Commits are checked by `commitlint` on commit and in CI, and the
changelog is generated from them with `git-cliff`.

```bash
make hooks      # enable the commit-msg hook, once per clone
make up         # start the Docker stack
make verify     # the checks a pull request has to pass
```

## Have any questions?
Mail to [victor@vgr.cl](mailto:victor@vgr.cl) or [yevhen.terentiev@gmail.com](mailto:yevhen.terentiev@gmai.com)

## READ MORE
- [Yii2](https://github.com/yiisoft/yii2/tree/master/docs)
- [Docker](https://docs.docker.com/get-started/)


### NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can start your application, rather than creating it from scratch.
Good luck!

