<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "key_storage_item".
 *
 * @property integer $key
 * @property integer $value
 */
class KeyStorageItem extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%key_storage_item}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['key'], 'string', 'max'=>128],
            [['value'], 'safe'],
            [['key'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'key' => Yii::t('common', 'Key'),
            'value' => Yii::t('common', 'Value'),
        ];
    }
}
