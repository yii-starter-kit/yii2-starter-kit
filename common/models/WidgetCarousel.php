<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "widget_carousel".
 *
 * @property integer $id
 * @property string $alias
 * @property integer $status
 *
 * @property WidgetCarouselItem[] $widgetCarouselItems
 */
class WidgetCarousel extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%widget_carousel}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias'], 'required'],
            [['alias'], 'unique'],
            [['status'], 'integer'],
            [['alias'], 'string', 'max' => 1024]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('common', 'ID'),
            'alias' => Yii::t('common', 'Alias'),
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
