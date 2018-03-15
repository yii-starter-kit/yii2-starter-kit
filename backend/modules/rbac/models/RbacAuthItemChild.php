<?php

namespace backend\modules\rbac\models;

use Yii;

/**
 * This is the model class for table "rbac_auth_item_child".
 *
 * @property string $parent
 * @property string $child
 *
 * @property RbacAuthItem $parent0
 * @property RbacAuthItem $child0
 */
class RbacAuthItemChild extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%rbac_auth_item_child}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['parent', 'child'], 'required'],
            [['parent', 'child'], 'string', 'max' => 64],
            [['parent'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['parent' => 'name']],
            [['child'], 'exist', 'skipOnError' => true, 'targetClass' => RbacAuthItem::class, 'targetAttribute' => ['child' => 'name']],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'parent' => Yii::t('app', 'Parent'),
            'child' => Yii::t('app', 'Child'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'parent']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getChild0()
    {
        return $this->hasOne(RbacAuthItem::class, ['name' => 'child']);
    }
}
