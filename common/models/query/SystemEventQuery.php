<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/5/14
 * Time: 10:46 AM
 */

namespace common\models\query;

use common\models\SystemEvent;
use yii\db\ActiveQuery;

class SystemEventQuery extends ActiveQuery{
    public function today(){
        $this->andWhere(SystemEvent::tableName().'.created_at > :midnight', [':midnight'=>strtotime('today midnight')]);
        return $this;
    }
} 