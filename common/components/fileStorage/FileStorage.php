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

/**
 * Class FileStorage
 * @package common\components\fileStorage
 */
class FileStorage extends \yii\base\Component{

    /**
     * @var array
     */
    public $repositories = [];
    /**
     * @var string
     */
    public $defaultRepository = 'filesystem';

    /**
     * @var array
     */
    public $_initiatedRepositories = [];

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
        foreach($this->repositories as $config){
            $repository = \Yii::createObject($config);
            $this->_initiatedRepositories[$repository->name] = $repository;
        }
    }

    /**
     * @param $file
     * @param null $category
     * @param null $repository
     * @return File
     */
    public function save($file, $category = null, $repository = null){
        $file = File::load($file);
        if($file) {
            return $this->getRepository($repository)->save($file, $category);
        }
    }

    /**
     * @param $files
     * @param null $category
     * @param null $repository
     * @return File[]
     */
    public function saveAll($files, $category = null, $repository = null){
        $result = [];
        foreach($files as $file){
            $result[] = $this->save($file, $category, $repository);
        }
        return $result;
    }

    /**
     * @param $file
     * @param null $repository
     * @return mixed
     */
    public function delete($file, $repository = null){
        $file = File::load($file);
        if($file) {
            return $this->getRepository($repository)->delete($file);
        }
    }

    /**
     * @param $files
     * @param null $repository
     */
    public function deleteAll($files, $repository = null){
        foreach($files as $file){
            $this->delete($file, $repository);
        }
    }

    /**
     * @param bool $name
     * @return mixed
     */
    public function getRepository($name = false){
        if(!$name){
            $name = $this->defaultRepository ?: ArrayHelper::getValue(array_keys($this->repositories), 0);
        }
        if(!$name || count($this->_initiatedRepositories) == 0 || !isset($this->_initiatedRepositories[$name])){
            throw new InvalidCallException;
        }
        return ArrayHelper::getValue($this->_initiatedRepositories, $name);
    }

    /**
     * @param $link
     * @param bool $path
     * @return bool|string Downloaded file path
     */
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

    /**
     * @return array
     */
    public function getAvailableRepositories(){
        $initiated = array_keys($this->_initiatedRepositories);
        return array_combine($initiated, $initiated);
    }
}