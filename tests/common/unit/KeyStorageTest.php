<?php

namespace tests\common\unit;

use Codeception\Test\Unit;
use Yii;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class KeyStorageTest extends Unit
{

    public function testKeyStorageSet()
    {
        Yii::$app->keyStorage->set('test.key', 'testValue');
        $this->assertEquals('testValue', Yii::$app->keyStorage->get('test.key', null, false));
        Yii::$app->keyStorage->set('test.key', 'anotherTestValue');
        $this->assertEquals('anotherTestValue', Yii::$app->keyStorage->get('test.key', null, false));
    }

    /**
     * @depends testKeyStorageSet
     */
    public function testKeyStorageHas()
    {
        $this->assertTrue(Yii::$app->keyStorage->has('test.key'));
        $this->assertFalse(Yii::$app->keyStorage->has('falseKey'));
    }

    /**
     * @depends testKeyStorageHas
     */
    public function testKeyStorageRemove()
    {
        Yii::$app->keyStorage->remove('test.key');
        $this->assertNull(Yii::$app->keyStorage->get('test.key', null, false));
        $this->assertFalse(Yii::$app->keyStorage->has('test.key', false));
    }
}
