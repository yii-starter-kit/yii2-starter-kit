<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "text_block".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $body
 * @property integer $status
 */
class TextBlock extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'text_block';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'body'], 'required'],
            [['body'], 'string'],
            [['status'], 'integer'],
            [['alias'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'alias' => Yii::t('app', 'Alias'),
            'title' => Yii::t('app', 'Title'),
            'body' => Yii::t('app', 'Body'),
            'status' => Yii::t('app', 'Status'),
        ];
    }
}
