<?php

namespace app\models;

use app\components\validators\JsonValidator;
use Yii;

/**
 * This is the model class for table "widget_menu".
 *
 * @property integer $id
 * @property string $alias
 * @property string $title
 * @property string $config
 * @property integer $status
 */
class WidgetMenu extends \yii\db\ActiveRecord
{
    const STATUS_ACTIVE = 1;
    const STATUS_DRAFT = 0;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'widget_menu';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['alias', 'title', 'config'], 'required'],
            [['alias'], 'unique'],
            [['config'], JsonValidator::className()],
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
            'config' => Yii::t('app', 'Config'),
            'status' => Yii::t('app', 'Status'),
        ];
    }

    public static function getConfigByAlias($alias){
        $model = self::findOne(['alias'=>$alias]);
        return $model && @json_decode($model->config) ? @json_decode($model->config) : [];
    }
}
