<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "i18_source_message".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property I18Message[] $i18Messages
 */
class I18NSourceMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%i18n_source_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category', 'message'], 'required'],
            [['message'], 'string'],
            [['category'], 'string', 'max' => 32]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'category' => Yii::t('backend', 'Category'),
            'message' => Yii::t('backend', 'Message'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getI18Messages()
    {
        return $this->hasMany(I18Message::className(), ['id' => 'id']);
    }
}
