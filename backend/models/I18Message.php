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
 * @property I18SourceMessage $id0
 */
class I18Message extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'i18_message';
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
            'id' => Yii::t('common', 'ID'),
            'language' => Yii::t('common', 'Language'),
            'translation' => Yii::t('common', 'Translation'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getId0()
    {
        return $this->hasOne(I18SourceMessage::className(), ['id' => 'id']);
    }
}
