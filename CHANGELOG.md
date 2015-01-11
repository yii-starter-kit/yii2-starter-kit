Yii Framework 2 Change Log
==========================

1.5.0 under development
-----------------------
- Enh: #79 chosen locale is stored in cookies
- Chg: application structure
- Chg #59: dotenv support
- Enh #61: Backend Cache Controller
- Enh: autocomplete now supports urlManagerFrontend and urlManagerBackend
- Enh #55: `components\grid\EnumColumn` for GridView
- Chng #52: Bower requirements was moved to composer
- Fix: Many `frontend/modules/user` fixes
- Fix: Autocompletion support
- Enh: FileCache now uses same path for all applications
- Enh: common\components\behaviors\CacheInvalidateBehavior
- ... Fixes ...

1.4.1
-----
- Cng #34: `Environment` class to configure application environment 
- Chg: message-migrate has moved to console/controllers/ExtendedMessageController - `yii message/migrate @common/config/messages/php.php @common/config/messages/db.php` 
- Eng #30: Tool to change code source language - `yii message/replace-source-language @path language-LOCALE`

1.4.0
-----
- Enh: backend user view page enhancement
- Enh #29: delete button on log record page
- Enh #28: init tool + local config files
- Fix #25: backend user update
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