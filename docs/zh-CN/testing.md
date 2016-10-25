# 测试

运行测试：

- 创建 `yii2-starter-kit-test` 数据库
- 调整 `.env` 文件中的 `TEST_DB_DSN`, `TEST_DB_USER` 和 `TEST_DB_PASSWORD` 参数
- 安装应用程序
```
php tests/codeception/bin/yii app/setup
```
- 启动Web服务器
```
php -S localhost:8080
```
- 运行测试：
```
cd tests
./../vendor/bin/codecept run
```