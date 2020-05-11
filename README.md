# Yii 2 Starter Kit

<!-- BADGES/ -->

[![Packagist](https://img.shields.io/packagist/v/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![Packagist](https://img.shields.io/packagist/dt/yii2-starter-kit/yii2-starter-kit.svg)](https://packagist.org/packages/yii2-starter-kit/yii2-starter-kit)
[![Build Status](https://travis-ci.org/yii2-starter-kit/yii2-starter-kit.svg?branch=master)](https://travis-ci.org/yii2-starter-kit/yii2-starter-kit)

<!-- /BADGES -->

This is Yii2 start application template.

It was created and developing as a fast start for building an advanced sites based on Yii2.

It covers typical use cases for a new project and will help you not to waste your time doing the same work in every project

## Before you start
Please, consider helping project via [contributions](https://github.com/yii2-starter-kit/yii2-starter-kit/issues) or [donations](#donations).

## TABLE OF CONTENTS
- [Demo](#demo)
- [Features](#features)
- [Installation](docs/installation.md)
    - [Manual installation](docs/installation.md#manual-installation)
    - [Docker installation](docs/installation.md#docker-installation)
    - [Vagrant installation](docs/installation.md#vagrant-installation)
- [Components documentation](docs/components.md)
- [Console commands](docs/console.md)
- [Testing](docs/testing.md)
- [FAQ](docs/faq.md)
- [How to contribute?](#how-to-contribute)
- [Have any questions?](#have-any-questions)

## Quickstart
1. [Install composer](https://getcomposer.org)
2. [Install docker](https://docs.docker.com/install/)
3. [Install docker-compose](https://docs.docker.com/compose/install/)
4. Run
    ```bash
    composer create-project yii2-starter-kit/yii2-starter-kit myproject.com --ignore-platform-reqs
    cd myproject.com
    composer run-script docker:build
    ```
5. Go to [http://yii2-starter-kit.localhost](http://yii2-starter-kit.localhost)

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
- Ready-to-use Docker-based stack (php, nginx, mysql, mailcatcher)
- .env support
- [Webpack](https://webpack.js.org/) build configuration
- Key-value storage service
- Ready to use REST API module
- [File storage component + file upload widget](https://github.com/trntv/yii2-file-kit)
- On-demand thumbnail creation [trntv/yii2-glide](https://github.com/trntv/yii2-glide)
- Built-in queue component [yiisoft/yii2-queue](https://github.com/yiisoft/yii2-queue)
- Command Bus with queued and async tasks support [trntv/yii2-command-bus](https://github.com/trntv/yii2-command-bus)
- `ExtendedMessageController` with ability to replace source code language and migrate messages between message sources
- [Some useful shortcuts](https://github.com/yii2-starter-kit/yii2-starter-kit/blob/master/common/helpers.php)

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
- Docker support and Vagrant support
- Built-in [mailcatcher](http://mailcatcher.me/)
- [Swagger](https://swagger.io/) for API docs.

## DEMO
Demo is hosted by awesome [Digital Ocean](https://m.do.co/c/d7f000191ea8)
- Frontend: [http://yii2-starter-kit.terentev.net](http://yii2-starter-kit.terentev.net)
- Backend: [http://backend.yii2-starter-kit.terentev.net](http://backend.yii2-starter-kit.terentev.net)

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

## Have any questions?
Mail to [eugene@terentev.net](mailto:eugene@terentev.net) or [victor@vgr.cl](mailto:victor@vgr.cl)

## READ MORE
- [Yii2](https://github.com/yiisoft/yii2/tree/master/docs)
- [Docker](https://docs.docker.com/get-started/)


### NOTE
This template was created mostly for developers NOT for end users.
This is a point where you can start your application, rather than creating it from scratch.
Good luck!

