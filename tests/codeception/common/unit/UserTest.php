<?php
namespace tests\codeception\common\unit;



use Yii;
use Codeception\Specify;
use common\models\LoginForm;
use tests\codeception\common\fixtures\UserFixture;
use yii\codeception\TestCase as Yii2TestCase;

class UserTest extends Yii2TestCase
{
    public $appConfig = '@tests/codeception/config/common/unit.php';

    /**
     * @var \tests\codeception\common\UnitTester
     */
    protected $tester;


    protected function _before()
    {

    }


    protected function _after()
    {
    }

    // tests
    public function testUser()
    {
        $user =  new \common\models\User();
        $user->email= "12345677713@test.com";
        $user->password_hash="1234";
        $user->username="<p>xss;</p>";
        $this->assertTrue($user->save());
        $this->assertTrue($user->username==='&lt;p&gt;xss;&lt;/p&gt;');
    }
}