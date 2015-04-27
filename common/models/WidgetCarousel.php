<?php

namespace common\models;

use common\behaviors\CacheInvalidateBehavior;
use Yii;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property integer $id
 * @property string $key
 * @property integer $status
 *
 * @property WidgetCarouselItem[] $items
 */
class WidgetCarousel extends \yii\db\ActiveRecord
{

    const STATUS_DRAFT = 0;
    const STATUS_ACTIVE = 1;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel}}';
    }

    public function behaviors()
    {
        return [
            'cacheInvalidate'=>[
                'class'=>CacheInvalidateBehavior::className(),
                'keys'=>[
                    function ($model) {
                        return [
                            self::className(),
                            $model->key
                        ];
                    }
                ]
            ]
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key'], 'required'],
            [['key'], 'unique'],
            [['status'], 'integer'],
            [['key'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'key' => Yii::t('common', 'Key'),
            'status' => Yii::t('common', 'Active'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getItems()
    {
        return $this->hasMany(WidgetCarouselItem::className(), ['carousel_id' => 'id']);
    }
}
