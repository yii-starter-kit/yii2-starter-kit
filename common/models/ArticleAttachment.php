<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%article_attachment}}".
 *
 * @property integer $id
 * @property integer $article_id
 * @property string $url
 *
 * @property Article $article
 */
class ArticleAttachment extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%article_attachment}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['article_id', 'url'], 'required'],
            [['article_id'], 'integer'],
            [['url'], 'string', 'max' => 2048]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'article_id' => Yii::t('common', 'Article ID'),
            'url' => Yii::t('common', 'Url'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getArticle()
    {
        return $this->hasOne(Article::className(), ['id' => 'article_id']);
    }
}
