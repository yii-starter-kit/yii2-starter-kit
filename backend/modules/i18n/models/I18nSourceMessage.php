<?php

namespace backend\modules\i18n\models;

use Yii;

/**
 * This is the model class for table "{{%i18n_source_message}}".
 *
 * @property integer $id
 * @property string $category
 * @property string $message
 *
 * @property I18nMessage[] $i18nMessages
 */
class I18nSourceMessage extends \yii\db\ActiveRecord
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
    public function getI18nMessages()
    {
        return $this->hasMany(I18nMessage::className(), ['id' => 'id'])->indexBy('language');
    }

    /**
     * Initialize messages.
     */
    public function initMessages()
    {
        $availableLocales = array_keys(Yii::$app->params['availableLocales']);
        $messages = [];
        foreach ($availableLocales as $language) {
            if (!isset($this->i18nMessages[$language])) {
                $message = new I18nMessage;
                $message->language = $language;
                $messages[$language] = $message;
            } else {
                $messages[$language] = $this->i18nMessages[$language];
            }
        }
        $this->populateRelation('i18nMessages', $messages);
    }

    /**
     * Store messages.
     */
    public function saveMessages()
    {
        /** @var I18nMessage $message */
        foreach ($this->i18nMessages as $message) {
            $this->link('i18nMessages', $message);
            $message->save();
        }
    }
}
