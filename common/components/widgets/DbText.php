<?php
/**
 * Eugine Terentev <eugine@terentev.net>
 */

namespace common\components\widgets;

use common\models\WidgetText;
use yii\caching\DbDependency;
use Yii;

/**
 * Class TextWidget
 * Return a text block content stored in db
 * @package common\components\widgets\text
 */
class DbText extends \yii\base\Widget{
    /**
     * @var string text block key
     */
    public $key;

    /**
     * @return string
     */
    public function run(){
        $cacheKey = [
            WidgetText::className(),
            $this->key
        ];
        $content = Yii::$app->cache->get($cacheKey);
        if(!$content){
            $model =  WidgetText::findOne(['key'=>$this->key, 'status'=>WidgetText::STATUS_ACTIVE]);
            if($model){
                $content = $model->body;
                Yii::$app->cache->set($cacheKey, $content, 60*60*24);
            }
        }
        return $content;
    }
}