<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/3/14
 * Time: 6:40 PM
 */

namespace common\components\keyStorage;

use common\models\KeyStorageItem;
use yii\base\Component;

class KeyStorage extends Component{
    public $cachePrefix = '_keyStorage';
    public $cachingDuration = 60;

    public function set($key, $value){
        $model = $this->getModel($key);
        if(!$model) return false;
        $model->value = $value;
        return $model->save();
    }

    public function get($key, $default = null, $cache = true){
        if($cache){
            $cacheKey = sprintf('%s.%s', $this->cachePrefix, $key);
            $value = \Yii::$app->cache->get($cacheKey);
            if($value === false){
                $model = $this->getModel($key);
                if($model){
                    $value = $model->value;
                    \Yii::$app->cache->set($cacheKey, $value, $this->cachingDuration);
                } else {
                    $value = $default;
                }
            }
        } else {
            $model = $this->getModel($key);
            $value = $model ? $model->value : $default;
        }
        return $value;
    }

    protected function getModel($key){
        return KeyStorageItem::findOne(['key'=>$key]);
    }
}