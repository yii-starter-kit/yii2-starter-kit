<?php

namespace backend\modules\rbac\models;

/**
 * This is the ActiveQuery class for [[RbacAuthItem]].
 *
 * @see RbacAuthItem
 */
class RbacAuthItemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * @inheritdoc
     * @return RbacAuthItem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * @inheritdoc
     * @return RbacAuthItem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
