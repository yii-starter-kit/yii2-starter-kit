#常问问题
## 1. Gii在哪里？
Gii可用网址：
- http://yii2-starter-kit.dev/gii
- http://backend.yii2-starter-kit.dev/gii

## 2. 如何启用电子邮件激活功能？
编辑 ``frontend/config/web.php`` 文件，将 [[frontend\modules\user\Module::shouldBeActivated]] 属性设置为 ``true``

## 3. 如何访问 mailcatcher ？
在docker部署中，mailcatcher 运行在 [yii2-starter-kit.dev:1080](yii2-starter-kit.dev:1080) 上

## 4. 在docker中运行应用程序时，如何打开应用程序cli？
在项目目录中运行命令：
```
docker exec -it $(docker-compose ps -q cli) bash
```