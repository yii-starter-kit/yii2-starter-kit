<?php
/**
 * Merged into backend/web/index-test.php. The rest of the application config is
 * already merged there, so only acceptance-specific overrides belong here.
 */
return [
    // php -S serves the app under /backend/web/index-test.php, so "/" would 404 after login.
    'homeUrl' => '/backend/web/index-test.php/site/index',
];

