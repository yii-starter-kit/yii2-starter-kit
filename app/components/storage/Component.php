<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:04 PM
 */

namespace app\components\storage;

use yii\base\InvalidCallException;
use yii\helpers\ArrayHelper;

class Component extends \yii\base\Component{

    public $targets = [];
    public $_initiatedTargets = [];

    private $_file;

    public function init(){
        foreach($this->targets as $name => $config){
            $this->_initiatedTargets[$name] = \Yii::createObject($config);
        }
    }

    public function load($file){
        $this->_file = File::load($file);
        return $this;
    }

    public function save($target = false){
        if(count($this->_initiatedTargets > 1) && !$target){
            throw new InvalidCallException;
        }
        if(!isset($this->_initiatedTargets[$target])){
            throw new InvalidCallException;
        }
        $this->_file = $this->_initiatedTargets[$target]->save($this->_file);
        return $this->_file;
    }

    public function getTarget($name){
        return ArrayHelper::getValue($this->_initiatedTargets, $name);
    }

    public function download($link){
        $tmpname = tempnam(sys_get_temp_dir(), 'yii');
        $file = file_get_contents($link);
        return file_put_contents($tmpname, $file);
    }
}