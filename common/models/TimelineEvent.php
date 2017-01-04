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


  /**
   * @return array
   */
  public function behaviors()
  {
    return [
      'timestamp' => [
        'class' => TimestampBehavior::className(),
        'createdAtAttribute' => 'created_at',
        'updatedAtAttribute' => null,
      ],
    ];
  }


  /**
   * @return TimelineEventQuery
   */
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
      [['application', 'category', 'event'], 'string', 'max' => 64],
    ];
  }


  /**
   * @inheritdoc
   */
  public function afterFind()
  {
    $this->data = @json_decode($this->data, true);
    parent::afterFind();
  }


  /**
   * @return string
   */
  public function getFullEventName()
  {
    return sprintf('%s.%s', $this->category, $this->event);
  }


  public function getTimeElapsedOfCreatedAt()
  {
    return $this->time_elapsed_string($this->created_at);
  }


  private function time_elapsed_string($previous_time)
  {
    $elapsed_time = time() - $previous_time;

    if ($elapsed_time < 1) {
      return '0 seconds';
    }

    $a = [
      365 * 24 * 60 * 60 => 'year',
      30 * 24 * 60 * 60 => 'month',
      24 * 60 * 60 => 'day',
      60 * 60 => 'hour',
      60 => 'minute',
      1 => 'second',
    ];
    $a_plural = [
      'year' => 'years',
      'month' => 'months',
      'day' => 'days',
      'hour' => 'hours',
      'minute' => 'minutes',
      'second' => 'seconds',
    ];

    foreach ($a as $secs => $str) {
      $d = $elapsed_time / $secs;
      if ($d >= 1) {
        $r = round($d);

        return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
      }
    }
  }
}
