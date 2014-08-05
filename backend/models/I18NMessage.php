<?php

namespace backend\models;

use Yii;

/**
 * This is the model class for table "i18_message".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 *
 * @property I18NSourceMessage $id0
 */
class I18NMessage extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%i18n_message}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'language', 'translation'], 'required'],
            [['id'], 'integer'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('backend', 'ID'),
            'language' => Yii::t('backend', 'Language'),
            'translation' => Yii::t('backend', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSource()
    {
        return $this->hasOne(I18NSourceMessage::className(), ['id' => 'id']);
    }

    public function getSourceMessage(){
        return $this->source ? $this->source->message: null;
    }

    public function getSourceCategory(){
        return $this->source ? $this->source->category: null;
    }
}
