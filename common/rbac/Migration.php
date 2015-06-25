<?php

namespace common\rbac;

use yii\base\Component;
use yii\db\MigrationInterface;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Migration extends Component implements MigrationInterface
{

    /**
     * @var string|\yii\rbac\BaseManager
     */
    public $auth = 'authManager';


    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init()
    {
        parent::init();
        $this->auth = \Yii::$app->get('authManager');
    }

    /**
     * This method contains the logic to be executed when applying this migration.
     * Child classes may override this method to provide actual migration logic.
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function up()
    {
    }

    /**
     * This method contains the logic to be executed when removing this migration.
     * The default implementation throws an exception indicating the migration cannot be removed.
     * Child classes may override this method if the corresponding migrations can be removed.
     * @return boolean return a false value to indicate the migration fails
     * and should not proceed further. All other return values mean the migration succeeds.
     */
    public function down()
    {
    }
}
