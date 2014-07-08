<?php

namespace app\models;

use app\components\behaviors\MysqlTimestampBehavior;
use app\models\query\ArticleQuery;
use Yii;
use yii\db\Expression;

/**
 * This is the model class for table "article".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $body
 * @property integer $user_id
 * @property integer $status
 * @property integer $published_at
 * @property integer $created_at
 * @property integer $updated_at
 *
 * @property User $user
 */
class Article extends \yii\db\ActiveRecord
{
    const STATUS_PUBLISHED = 0;
    const STATUS_DRAFT = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'article';
    }

    public static function find()
    {
        return new ArticleQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            MysqlTimestampBehavior::className(),
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'body'], 'required'],
            [['body'], 'string'],
            [['published_at'], 'default', 'value'=>new Expression('NOW()')],
            [['user_id'], 'default', 'value'=>Yii::$app->user->id],
            [['user_id', 'status'], 'integer'],
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
            'user_id' => Yii::t('app', 'User ID'),
            'status' => Yii::t('app', 'Status'),
            'published_at' => Yii::t('app', 'Published At'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
