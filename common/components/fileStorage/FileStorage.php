<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:04 PM
 */

namespace common\components\fileStorage;

use yii\base\InvalidCallException;
use yii\helpers\ArrayHelper;

class FileStorage extends \yii\base\Component{

    public $repositories = [];
    public $defaultRepository = 'filesystem';

    public $_initiatedRepositories = [];

    public function init(){
        foreach($this->repositories as $config){
            $repository = \Yii::createObject($config);
            $this->_initiatedRepositories[$repository->name] = $repository;
        }
    }

    public function save($file, $category = null, $repository = null){
        return $this->getRepository($repository)->save(File::load($file), $category);
    }

    public function saveAll($files, $category = null, $repository = null){
        $result = [];
        foreach($files as $file){
            $result[] = $this->save($file, $category, $repository);
        }
        return $result;
    }

    public function delete($file, $repository = null){
        return $this->getRepository($repository)->delete($file);
    }

    public function deleteAll($files, $repository = null){
        foreach($files as $file){
            $this->delete($file, $repository);
        }
    }

    public function getRepository($name = false){
        if(!$name){
            $name = $this->defaultRepository ?: ArrayHelper::getValue(array_keys($this->repositories), 0);
        }
        if(!$name || count($this->_initiatedRepositories) == 0 || !isset($this->_initiatedRepositories[$name])){
            throw new InvalidCallException;
        }
        return ArrayHelper::getValue($this->_initiatedRepositories, $name);
    }

    public function download($link, $path = false){
        if(!$path){
            $path = tempnam(sys_get_temp_dir(), 'yii');
        }
        ;
        if(!($file = file_get_contents($link)) || file_put_contents($path, $file) === false){
            return false;
        }
        return $path;
    }

    public function getAvailableRepositories(){
        $initiated = array_keys($this->_initiatedRepositories);
        return array_combine($initiated, $initiated);
    }
}