<?php

namespace backend\modules\rbac\models;

/**
 * This is the ActiveQuery class for [[RbacAuthAssignment]].
 *
 * @see RbacAuthAssignment
 */
class RbacAuthAssignmentQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RbacAuthAssignment[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RbacAuthAssignment|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
