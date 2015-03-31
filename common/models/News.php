<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "news".
 *
 * @property integer $id
 * @property string $slug
 * @property string $title
 * @property string $body
 * @property integer $category_id
 * @property integer $author_id
 * @property integer $updater_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 * @property NewsAttachment[] $newsAttachments
 */
class News extends \yii\db\ActiveRecord
{
    /**
     * @var array
     */
    public $attachments = [];

    const STATUS_PUBLISHED = 1;
    const STATUS_DRAFT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%news}}';
    }


    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title', 'body'], 'required'],
            [['slug'], 'unique'],
            [['body'], 'string'],
            [['published_at'], 'default', 'value'=>time()],
            [['published_at'], 'filter', 'filter'=>'strtotime'],
            [['category_id'], 'exist', 'targetClass' => NewsCategory::className(), 'targetAttribute'=>'id'],
            [['author_id', 'updater_id', 'status'], 'integer'],
            [['slug'], 'string', 'max' => 1024],
            [['title'], 'string', 'max' => 512],
            [['attachments'], 'safe']
        ];

    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'slug' => Yii::t('common', 'Slug'),
            'title' => Yii::t('common', 'Title'),
            'body' => Yii::t('common', 'Body'),
            'author_id' => Yii::t('common', 'Author'),
            'updater_id' => Yii::t('common', 'Updater'),
            'category_id' => Yii::t('common', 'Category'),
            'status' => Yii::t('common', 'Published'),
            'published_at' => Yii::t('common', 'Published At'),
            'created_at' => Yii::t('common', 'Created At'),
            'updated_at' => Yii::t('common', 'Updated At')
        ];
    }


    /**
     * @return \yii\db\ActiveQuery
     */
    public function getAuthor()
    {
        return $this->hasOne(User::className(), ['id' => 'author_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUpdater()
    {
        return $this->hasOne(User::className(), ['id' => 'updater_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCategory()
    {
        return $this->hasOne(NewsCategory::className(), ['id' => 'category_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getNewsAttachments()
    {
        return $this->hasMany(NewsAttachment::className(), ['news_id' => 'id']);
    }

    /**
     * @inherit
     */
    public function afterFind()
    {
        $this->attachments = ArrayHelper::getColumn($this->newsAttachments, 'url');
        parent::afterFind();
    }

    /**
     * @param bool $insert
     * @param array $changedAttributes
     */
    public function afterSave($insert, $changedAttributes)
    {
        NewsAttachment::deleteAll(['and', ['news_id' => $this->id], ['not in', 'url', $this->attachments]]);
        $existingAttachments = ArrayHelper::getColumn($this->getNewsAttachments()->all(), 'url');
        if (is_array($this->attachments)) {
            foreach ($this->attachments as $url) {
                if (!in_array($url, $existingAttachments, true)) {
                    $model = new NewsAttachment();
                    $model->url = $url;
                    $this->link('newsAttachments', $model);
                }
            }
        }
        parent::afterSave($insert, $changedAttributes);
    }
}
