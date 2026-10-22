#FAQ
## 1. Where is Gii?
Gii is available on:
- http://yii2-starter-kit.localhost/gii
- http://backend.yii2-starter-kit.localhost/gii

## 2. How do I enable email activation?
Edit ``frontend/config/web.php`` and set [[frontend\modules\user\Module::shouldBeActivated]] property to ``true``

## 3. How do I access Mailpit?
In the docker installation, Mailpit is running on [localhost:8025](http://localhost:8025)

## 4. How do I open application cli when run application in docker?
Run this command in project directory:
```
docker compose exec console php console/yii <command> [arguments]
```
## 5. How do I change charset in existing database?
```
docker compose exec console php console/yii app/alter-charset <charset> <collation>
```
