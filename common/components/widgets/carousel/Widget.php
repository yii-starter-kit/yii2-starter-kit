<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 6:17 PM
 */

namespace common\components\widgets\carousel;

use common\models\WidgetCarousel;
use yii\base\InvalidConfigException;
use yii\bootstrap\Carousel;
use yii\helpers\Html;

class Widget extends Carousel{
    public $alias;

    public function init(){
        if(!$this->alias){
            throw new InvalidConfigException;
        }
        $model = WidgetCarousel::find()
            ->with(['items'=>function($query){
                return $query->where(['status'=>1])->orderBy(['order'=>SORT_ASC]);
            }])
            ->where(['alias'=>$this->alias])
            ->one();
        if($model){
            foreach($model->items as $k => $item){
                if($item->path){
                    $this->items[$k]['content'] = Html::img($item->path);
                }
                if($item->url){
                    $this->items[$k]['content'] = Html::a($this->items[$k]['content'], $item->url,['target'=>'_blank']);
                }

                if($item->caption){
                    $this->items[$k]['caption'] = $item->caption;
                }
            }
        }
        parent::init();
    }

} 