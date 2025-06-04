<?php

return [
    [
        'parent' => 'user',
        'child' => 'editOwnModel',
    ],
    [
        'parent' => 'manager',
        'child' => 'loginToBackend',
    ],
    [
        'parent' => 'administrator',
        'child' => 'manager',
    ],
    [
        'parent' => 'manager',
        'child' => 'user',
    ],
];
