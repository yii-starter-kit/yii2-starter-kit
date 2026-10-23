# Console commands

The console application lives in `console/`. Run commands from the project root, and inside Docker
prefix them with `docker compose exec console`.

```bash
php console/yii <command>                                 # on the host
docker compose exec console php console/yii <command>      # in the Docker stack
```

Add `--interactive=0` to a command that asks for confirmation when you script it.

## Application setup

| Command | What it does |
| --- | --- |
| `app/setup` | Full setup: `set-writable`, `set-executable`, `set-keys`, then `migrate/up` and `rbac-migrate/up` |
| `app/set-keys` | Writes random values for the `<generated_key>` placeholders in `.env` |
| `app/set-writable` | Makes the `runtime` directories writable |
| `app/set-executable` | Makes the `yii` entry points executable |
| `app/demo-data [count]` | Inserts random categories and articles, `10` of each by default |
| `app/alter-charset [charset] [collation]` | Converts every table, MySQL only |

`app/truncate` empties every table and `app/drop` drops them. Both ask for confirmation and both
destroy data.

## Migrations

```bash
php console/yii migrate/up              # apply database migrations
php console/yii migrate/down 1          # revert the last migration
php console/yii migrate/create name     # create a migration in common/migrations/db
```

## RBAC migrations

RBAC migrations live in `common/migrations/rbac` and are run separately from the database
migrations.

```bash
php console/yii rbac-migrate/up                 # apply
php console/yii rbac-migrate/down all           # revert everything
php console/yii rbac-migrate/create init_roles  # create a new one
```

## Messages

`ExtendedMessageController` adds two actions to the framework's message command.

```bash
# copy messages from the PHP source into the database source
php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php

# switch the language of the source strings
php console/yii message/replace-source-language @common/config/messages/php.php ru-RU

# strip Yii::t() calls from the source code
php console/yii message/replace-source-language @common/config/messages/php.php
```

To read and write messages from the database, uncomment the `DbMessageSource` block in
`common/config/base.php` first.

## Queue

The queue uses the file driver and stores jobs in `common/runtime/queue`.

```bash
php console/yii queue/run      # process the queue, then exit
php console/yii queue/listen   # keep polling for new jobs
```
