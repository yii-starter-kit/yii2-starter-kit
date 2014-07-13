<?php

namespace app\models;

use Yii;
use yii\imagine\Image;
use yii\web\UploadedFile;

/**
 * This is the model class for table "widget_carousel_item".
 *
 * @property integer $id
 * @property integer $carousel_id
 * @property string $path
 * @property string $url
 * @property string $caption
 * @property integer $status
 * @property integer $order
 *
 * @property WidgetCarousel $widget
 */
class WidgetCarouselItem extends \yii\db\ActiveRecord
{

    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_carousel_item';
    }

    public function scenarios(){
        $scenarios = parent::scenarios();
        $key = array_search('carousel_id', $scenarios[self::SCENARIO_DEFAULT]);
        $scenarios[self::SCENARIO_DEFAULT][$key] = '!carousel_id';
        return $scenarios;
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['carousel_id'], 'required'],
            [['path'],'string'],
            [['file'], 'file', 'extensions'=>['jpeg', 'jpg', 'png']],
            [['carousel_id', 'status', 'order'], 'integer'],
            [['path', 'url', 'caption'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'carousel_id' => Yii::t('app', 'Carousel ID'),
            'path' => Yii::t('app', 'Path'),
            'url' => Yii::t('app', 'Url'),
            'caption' => Yii::t('app', 'Caption'),
            'status' => Yii::t('app', 'Status'),
            'order' => Yii::t('app', 'Order'),
        ];
    }

    public function afterValidate(){
        parent::afterValidate();
        $file = UploadedFile::getInstance($this, 'file');
        if ($file && !$file->hasError && !$this->hasErrors()) {
            $this->path = Yii::$app->storage->load($file)->save('fs')->url;
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getWidget()
    {
        return $this->hasOne(WidgetCarousel::className(), ['id' => 'carousel_id']);
    }
}
