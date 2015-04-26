<?php

namespace tests\codeception\common\unit;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class KeyStorageTest extends TestCase
{

    public function testKeyStorageSet()
    {
        \Yii::$app->keyStorage->set('test.key', 'testValue');
        $this->assertEquals('testValue', \Yii::$app->keyStorage->get('test.key', null, false));
    }

    public function testKeyStorageHas()
    {
        $this->assertTrue(\Yii::$app->keyStorage->has('frontend.maintenance'));
        $this->assertFalse(\Yii::$app->keyStorage->has('falseKey'));
    }

    public function testKeyStorageGet()
    {
        $this->assertEquals('0', \Yii::$app->keyStorage->get('frontend.maintenance'));
    }

    public function testKeyStorageRemove()
    {
        \Yii::$app->keyStorage->remove('frontend.maintenance');
        $this->assertFalse(\Yii::$app->keyStorage->has('frontend.maintenance'));
    }
}
