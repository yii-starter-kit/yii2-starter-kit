<?php
/**
 * Merged into frontend/web/index-test.php. The rest of the application config is
 * already merged there, so only acceptance-specific overrides belong here.
 */
return [
    // php -S serves the app under /frontend/web/index-test.php, so "/" would 404 after login.
    'homeUrl' => '/frontend/web/index-test.php/site/index',
];
