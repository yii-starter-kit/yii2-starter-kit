<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/3/14
 * Time: 6:40 PM
 */

namespace common\components\keyStorage;

use yii\base\Component;
use yii\helpers\ArrayHelper;
use Yii;

/**
 * Class KeyStorage
 * @package common\components\keyStorage
 */
class KeyStorage extends Component{
    /**
     * @var string
     */
    public $cachePrefix = '_keyStorage';
    /**
     * @var int
     */
    public $cachingDuration = 60;
    /**
     * @var string
     */
    public $modelClass = '\common\models\KeyStorageItem';

    /**
     * @var array Runtime values cache
     */
    private $_values = [];

    /**
     * @param $key
     * @param $value
     * @return mixed
     */
    public function set($key, $value){
        $this->_values[$key] = $value;
        $model = $this->getModel($key);
        if(!$model) $model = new $this->modelClass;
        $model->key = $key;
        $model->value = $value;
        return $model->save();
    }

    /**
     * @param array $values
     */
    public function setAll(array $values){
        foreach($values as $key => $value){
            $this->set($key, $value);
        }
    }

    /**
     * @param $key
     * @param null $default
     * @param bool $cache
     * @return mixed|null
     */
    public function get($key, $default = null, $cache = true){
        if($cache){
            $cacheKey = sprintf('%s.%s', $this->cachePrefix, $key);
            $value = ArrayHelper::getValue($this->_values, $key, false) ?: Yii::$app->cache->get($cacheKey);
            if($value === false){
                if($model = $this->getModel($key)){
                    $value = $model->value;
                    $this->_values[$key] = $value;
                    Yii::$app->cache->set($cacheKey, $value, $this->cachingDuration);
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

    /**
     * @param array $keys
     */
    public function getAll(array $keys){
        $values = [];
        foreach($keys as $key){
            $values[$key] = $this->get($key);
        }
        return $values;
    }

    /**
     * @param $key
     * @return mixed
     */
    public function remove($key){
        return call_user_func($this->modelClass.'::deleteAll', ['key'=>$key]);
    }

    /**
     * @param array $keys
     */
    public function removeAll(array $keys){
        foreach($keys as $key){
            $this->remove($key);
        }
    }

    /**
     * @param $groupKey
     * @return mixed
     */
    public function removeGroup($groupKey){
        return call_user_func($this->modelClass.'::deleteAll', ['like', 'key', $groupKey]);
    }

    /**
     * @param $key
     * @return mixed
     */
    protected function getModel($key){
        $query = call_user_func($this->modelClass.'::find');
        return $query->where(['key'=>$key])->select(['key', 'value'])->one();
    }
}