Yii Starter Kit Change Log
==========================

2.1.0 under development
-----------------------
- Enh #189: Added command bus
- Changed application setup proccess 
- Enh #184: Preserve article attachments file name
- Enh #176: Added ability to set custom view for static pages and articles
- Enh #160: LocaleBehavior::enablePreferredLanguage
- fixes and improvements

2.0.0 
-----
- Enh: Added Spanish locale
- Enh: Frontend Account and Profile actions merged into one
- Enh #146: Added MultiModel for handling multiple models at once
- Enh #145: Added Application settings + FormModel and FormWidget for keyStorage component
- Fixed: KeyStorage::set()
- Enh #147: implemented KeyStorage::has() and KeyStorage::hasAll()
- Enh: EnumColumn now loads enum as filter items
- Enh #37: REST API module example
- Enh #119: Removed default roles
- Enh #128: Articles are available via slugs
- Added Vagrant support
- testing framework configuration
- Imperavi redactor plugins enabled
- Upload Kit updated to 1.0
- AdminLTE updated to 2.0 branch
- PSR2 formatting
- ... fixes and many small changes ...

1.5.1
-----
- fixes

1.5.0
-----
- Enh: ``$cachingDuration`` parameter was added to ``common\components\keyStorage\KeyStorage::get``
- Fix: contact form fix
- Enh: "robot" email now ca be set in .env
- Enh #72: Maintenance mode
- Enh: #79 chosen locale is stored in cookies
- Enh: #84 Article Attachments
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