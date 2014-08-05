<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/5/14
 * Time: 10:46 AM
 */

namespace backend\models\query;


use backend\models\SystemEvent;
use yii\db\ActiveQuery;

class SystemEventQuery extends ActiveQuery{
    public function today(){
        $this->andWhere(SystemEvent::tableName().'.event_time > :midnight', [':midnight'=>strtotime('today midnight')]);
        return $this;
    }
} 