<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 6/23/14
 * Time: 10:30 AM
 */

namespace common\components\widgets\text;

use common\models\WidgetText;
use yii\caching\DbDependency;
use Yii;

/**
 * Class TextWidget
 * Return a text block content stored in db
 * @package common\components\widgets\text
 */
class TextWidget extends \yii\base\Widget{
    /**
     * @var string text block alias
     */
    public $alias;

    /**
     * @return string
     */
    public function run(){
        $content = Yii::$app->cache->get("widget_text_{$this->alias}");
        if(!$content){
            $model =  WidgetText::findOne(['alias'=>$this->alias, 'status'=>1]);
            if($model){
                $content = $model->body;
                Yii::$app->cache->set("widget_text_{$this->alias}", $content, 3600, new DbDependency([
                    'sql' => sprintf('SELECT MAX(updated_at) FROM %s', WidgetText::tableName())
                ]));
            }
        }
        echo $content;
    }
}