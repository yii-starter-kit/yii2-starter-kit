# 控制台
## 应用控制器
``php console/yii app/setup`` 

## 扩展消息控制器
此扩展做为默认的消息控制器以提供一些有用的操作：

- 在不同的消息来源之间迁移消息：
``php console/yii message/migrate @common/config/messages/php.php @common/config/messages/db.php``

- 替换源语言：
``php console/yii message/replace-source-language @common/config/messages/php.php ru-RU``
或者任何其他的语言环境

- 从源代码中删除 ``Yii::t`` 
``php console/yii message/replace-source-language @common/config/messages/php.php``

## Rbac迁移控制器
提供RBAC的迁移功能。

``php console/yii rbac-migrate/create init_roles``

``php console/yii rbac-migrate/up``

``php console/yii rbac-migrate/down all``

### 压缩资源
你需要安装 yuicompressor 和 uglifyjs 。

```php console/yii asset/compress frontend/config/assets/compress.php frontend/config/assets/_bundles.php```

然后编辑 ``frontend/config/web.php`` ，对以下行取消注释
```
// Compressed assets
//$config['components']['assetManager'] = [
//   'bundles' => require(__DIR__ . '/assets/_bundles.php')
//];
```
