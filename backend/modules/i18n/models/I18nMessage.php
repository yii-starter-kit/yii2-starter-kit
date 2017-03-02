<?php

namespace backend\modules\i18n\models;

use Yii;

/**
 * This is the model class for table "{{%i18n_message}}".
 *
 * @property integer $id
 * @property string $language
 * @property string $translation
 * @property string $sourceMessage
 * @property string $category
 *
 * @property I18nSourceMessage $sourceMessageModel
 */
class I18nMessage extends \yii\db\ActiveRecord
{
    public $category;
    public $sourceMessage;

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
            [['id', 'language'], 'required'],
            [['id'], 'exist', 'targetClass'=>I18nSourceMessage::className(), 'targetAttribute'=>'id'],
            [['translation'], 'string'],
            [['language'], 'string', 'max' => 16],
            [['language'], 'unique', 'targetAttribute' => ['id', 'language']]
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
            'sourceMessage' => Yii::t('backend', 'Source Message'),
            'category' => Yii::t('backend', 'Category'),
        ];
    }

    public function afterFind()
    {
        $this->sourceMessage = $this->sourceMessageModel ? $this->sourceMessageModel->message : null;
        $this->category = $this->sourceMessageModel ? $this->sourceMessageModel->category : null;
        return parent::afterFind();
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSourceMessageModel()
    {
        return $this->hasOne(I18nSourceMessage::className(), ['id' => 'id']);
    }
}
