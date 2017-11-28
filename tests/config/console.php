<?php
return [
    'controllerMap' => [
        'fixture' => [
            'class' => yii\faker\FixtureController::class,
            'fixtureDataPath' => '@tests/common/fixtures/data',
            'templatePath' => '@tests/common/templates/fixtures',
            'namespace' => 'tests\common\fixtures',
        ],
    ],
];
