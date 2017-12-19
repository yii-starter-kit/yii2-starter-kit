<?php

namespace backend\modules\rbac\models;

/**
 * This is the ActiveQuery class for [[RbacAuthRule]].
 *
 * @see RbacAuthRule
 */
class RbacAuthRuleQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RbacAuthRule[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RbacAuthRule|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
