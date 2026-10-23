# FAQ

## 1. Where is Gii?

Gii is registered only when `YII_ENV=dev`, on the frontend and on the backend:

- http://yii2-starter-kit.localhost/gii
- http://backend.yii2-starter-kit.localhost/gii

## 2. How do I enable email activation?

Set `shouldBeActivated` to `true` in the `user` module configuration in `frontend/config/web.php`.

## 3. Where do the emails go?

In the Docker stack, Mailpit catches every message: http://localhost:8025. The host and port come
from `SMTP_HOST` and `SMTP_PORT`, documented in [configuration.md](configuration.md#mail).

## 4. How do I run console commands in Docker?

```bash
docker compose exec console php console/yii <command> [arguments]
```

## 5. How do I change the charset of an existing database?

```bash
docker compose exec console php console/yii app/alter-charset <charset> <collation>
```

The default is `utf8mb4` with `utf8mb4_unicode_ci`, and the command only supports MySQL.

## 6. How do I reset the database?

```bash
docker compose exec console php console/yii app/truncate   # empty every table
docker compose exec console php console/yii app/drop       # drop every table
```

Both ask for confirmation and delete data. Stopping the stack has the same effect, because MySQL
keeps its data in an anonymous volume: `make down` followed by `make up` gives you an empty
database, and `make build` recreates the schema.

## 7. Port 80 is already in use. What now?

Change the published port of the `nginx` service in `docker-compose.yml`:

```yaml
ports:
  - 8080:80
```

Then add the port to the `*_HOST_INFO` values in `.env` and to the hosts entries for the
application domains.

## 8. Where is the API documentation?

Swagger UI is at the root of the API application, http://api.yii2-starter-kit.localhost. The
resources live under `/v1`, for example `/v1/articles`.

## 9. The browser cannot open http://yii2-starter-kit.localhost. What is wrong?

The name has to resolve to `127.0.0.1`. Many systems do that automatically; if yours does not, add
the four names to `/etc/hosts`:

```text
127.0.0.1 yii2-starter-kit.localhost backend.yii2-starter-kit.localhost api.yii2-starter-kit.localhost storage.yii2-starter-kit.localhost
```

Also check that nothing else is listening on port 80, and that `docker compose ps` shows `nginx`
with `0.0.0.0:80->80/tcp`. When the port is already taken, Docker can start the container without
publishing the port.
