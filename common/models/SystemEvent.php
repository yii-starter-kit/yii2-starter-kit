<?php

namespace common\models;

use common\models\query\SystemEventQuery;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "system_event".
 *
 * @property integer $id
 * @property string $category
 * @property string $event
 * @property string $data
 * @property string $created_at
 */
class SystemEvent extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%system_event}}';
    }

    public function behaviors(){
        return [
            'timestamp'=>[
                'class'=>TimestampBehavior::className(),
                'createdAtAttribute'=>'created_at',
                'updatedAtAttribute'=>null
            ]
        ];
    }

    public static function find()
    {
        return new SystemEventQuery(get_called_class());
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

    public function getFullEventName(){
        return sprintf('%s.%s', $this->category, $this->event);
    }

    public function getName(){
        $names = [
            'user'=>[
                User::EVENT_AFTER_SIGNUP => Yii::t('backend', 'New user')
            ]
        ];
        return ArrayHelper::getValue($names, $this->getFullEventName(), $this->getFullEventName());
    }

    public function getMessage(){
        $messages = [
            'user'=>[
                User::EVENT_AFTER_SIGNUP => Yii::t('backend', 'New user {username} ({email}) was registered at {created_at, date} {created_at, time}', $this->data)
            ]
        ];
        return ArrayHelper::getValue($messages, $this->getFullEventName());
    }

    public static function log($category, $event, $data = null){
        $model = new self;
        $model->application = Yii::$app->id;
        $model->category = $category;
        $model->event = $event;
        $model->data = $data;
        return $model->save();
    }

    public function beforeValidate(){
        $this->data = ($this->data !== null) ? json_encode($this->data) : $this->data;
        return parent::beforeValidate();
    }
    public function afterFind(){
        $this->data = @json_decode($this->data);
        parent::afterFind();
    }
}
