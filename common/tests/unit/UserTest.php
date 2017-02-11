<?php
namespace tests\codeception\common\unit;

class UserTest extends \Codeception\Test\Unit
{

    /**
     * @var \common\tests\UnitTester
     */
    protected $tester;

    // tests
    public function testUser()
    {
        $user =  new \common\models\User();
        $user->email= "12345677713@test.com";
        $user->password_hash="1234";
        $user->username="<p>xss;</p>";
        $this->assertTrue($user->save());
        $this->tester->seeRecord(
            \common\models\User::className(),
            ['username' => '&lt;p&gt;xss;&lt;/p&gt;']
        );
    }
}