<?php

namespace tests\common\unit;

use Codeception\Test\Unit;

class UserTest extends Unit
{

    /**
     * @var \tests\common\UnitTester
     */
    protected $tester;

    /**
     * @throws \Exception
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     */
    public function testUser()
    {
        $user = new \common\models\User();
        $user->email = "12345677713@test.com";
        $user->password_hash = "1234";
        $user->username = "<p>xss;</p>";
        $this->assertTrue($user->save());
        $this->assertTrue($user->username === '&lt;p&gt;xss;&lt;/p&gt;');
        $this->assertTrue((boolean)$user->delete());
    }
}
