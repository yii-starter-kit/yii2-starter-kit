<?php

namespace common\models;

use common\models\query\TimelineEventQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;

/**
 * This is the model class for table "timeline_event".
 *
 * @property integer $id
 * @property string $application
 * @property string $category
 * @property string $event
 * @property string $data
 * @property string $created_at
 */
class TimelineEvent extends ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%timeline_event}}';
    }

    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'createdAtAttribute' => 'created_at',
                'updatedAtAttribute' => null
            ]
        ];
    }

    public static function find()
    {
        return new TimelineEventQuery(get_called_class());
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['application', 'category', 'event'], 'required'],
            [['data'], 'safe'],
            [['application', 'category', 'event'], 'string', 'max' => 64]
        ];
    }

    public function afterFind()
    {
        $this->data = @json_decode($this->data, true);
        parent::afterFind();
    }

    public function getFullEventName()
    {
        return sprintf('%s.%s', $this->category, $this->event);
    }

    public static function log($category, $event, $data = null)
    {
        $model = new TimelineEvent();
        $model->application = Yii::$app->id;
        $model->category = $category;
        $model->event = $event;
        $model->data = json_encode($data, JSON_UNESCAPED_UNICODE);
        return $model->save(false);
    }
}
