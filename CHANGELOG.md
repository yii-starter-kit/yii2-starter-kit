Yii Framework 2 Change Log
==========================

1.4.0 under development
-----------------------
- Chg: added utf-8 charset to nginx.conf
- Enh: Added filters for `log` and `file-storage` grids
- Enh: Backend now use `yii\bootstrap\ActiveForm` instead of `yii\widgets\ActiveForm`
- Enh: added `getFullName` for `UserProfile` and `getPublicIdentity` for `User`
- Fix: added some settings to prevent postfix `fatal: usage: sendmail [options]` error
- Enh: Gii Module has separate configs for backend and frontend
- Enh: Added gii templates for backend
- Enh: Time information on "system information" screen
- Fix #12: Locale bug
- Enh: I18N validation rules
- Enh: User backend controller don't available for `manager`
- Enh #11: OAuth authorization
- Fix #13: Article showing fix
- Enh: Xhprof debug panel
- ... many small enhancements and bugfixes ...

1.3.0
-----
- Enh: message configs for db, php and po formats
- Enh: `MessageController` migrate action
- Enh: I18N CRUD module
- Enh: `common\components\action\SetLocale`
- Enh: backendUrlManager, frontendUrlManager, bootstrap application

... enhancements, bugfixes