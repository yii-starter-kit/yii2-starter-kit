<?php

namespace backend\modules\rbac\models;

/**
 * This is the ActiveQuery class for [[RbacAuthItemChild]].
 *
 * @see RbacAuthItemChild
 */
class RbacAuthItemChildQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RbacAuthItemChild[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RbacAuthItemChild|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
