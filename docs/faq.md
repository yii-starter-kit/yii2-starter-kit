#FAQ
## 1. Where is Gii?
Gii is available on:
- http://yii2-starter-kit.dev/gii
- http://backend.yii2-starter-kit.dev/gii

## 2. How do i enable email activation?
Edit ``frontend/config/web.php`` and set [[frontend\modules\user\Module::shouldBeActivated]] property to ``true``

## 3. How do i open application cli when run application in docker?
Run this command in project directory:
```
docker-compose exec -it app bash
```