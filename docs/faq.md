#FAQ
## 1. Where is Gii?
Gii is available on:
- http://yii2-starter-kit.localhost/gii
- http://backend.yii2-starter-kit.localhost/gii

## 2. How do I enable email activation?
Edit ``frontend/config/web.php`` and set [[frontend\modules\user\Module::shouldBeActivated]] property to ``true``

## 3. How do I access the mail UI?
In the Docker setup Mailpit is running on [http://localhost:1080](http://localhost:1080). Outgoing mail from the app is caught automatically — no real emails are sent.

## 4. How do I run Yii console commands inside Docker?
Use the `ysk` helper:
```bash
./console/ysk yii migrate/up
./console/ysk yii cache/flush-all
./console/ysk yii rbac-migrate/up
```
Or open a shell directly:
```bash
./console/ysk shell
# then inside the container:
php console/yii help
```
See [docs/docker.md](docker.md) for the full command reference.

## 5. How do I connect to the database from a GUI client?
MySQL is exposed on `localhost:3306`. Credentials are set in your `.env` file (defaults: user `ysk_dbu`, password `ysk_pass`, root password `root`).

## 6. How do I change charset in an existing database?
```bash
./console/ysk yii app/alter-charset <charset> <collation>
```

## 7. Browser shows the nginx welcome page instead of the app

A locally installed nginx, Apache, or MySQL on your host is bound to the same port (80 or 3306) and intercepts requests before Docker. Stop the conflicting host services:

```bash
sudo service nginx stop
sudo service apache2 stop
sudo service mysql stop
```

See [docs/docker.md — Troubleshooting](docker.md#troubleshooting) for more detail.
