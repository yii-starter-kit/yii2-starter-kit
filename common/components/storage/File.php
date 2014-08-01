<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 2:00 PM
 */

namespace common\components\storage;


use yii\base\InvalidCallException;
use yii\base\Object;
use yii\validators\UrlValidator;
use yii\web\UploadedFile;

/**
 * Class File
 * @package common\components\storage
 */
class File extends Object{

    /**
     * @var bool is file stored flag
     */
    public $is_stored = false;

    /**
     * @var filename
     */
    public $name;

    /**
     * @var file extension
     */
    public $extension;

    /**
     * @var file path
     */
    private $_path;

    /**
     * @var file web accessible address
     */
    private $_url;

    /**
     * @var filesize
     */
    private $_size;

    /**
     * @var error container
     */
    private $_error;

    /**
     * @param $file
     * @return object
     * @throws \yii\base\InvalidConfigException
     */
    public static function load($file){

        // UploadedFile
        if(is_a($file, UploadedFile::className())){
            return \Yii::createObject([
                'class'=>self::className(),
                'path'=>$file->tempName,
                'extension'=>$file->getExtension()
            ]);
        }
        $urlValidator = \Yii::createObject([
            'class'=>UrlValidator::className()
        ]);

        // Url
        if($urlValidator->validateValue === null){
            return \Yii::createObject([
                'class'=>self::className(),
                'path'=>\Yii::$app->storage->download($file),
                'extension'=>pathinfo($file, PATHINFO_EXTENSION)
            ]);
        }

        // Path
        return \Yii::createObject([
            'class'=>self::className(),
            'path'=>$file,
            'extension'=>pathinfo($file, PATHINFO_EXTENSION)
        ]);
    }

    /**
     * Init component
     */
    public function init(){
        $this->_size = filesize($this->getPath());
        if(!$this->name){
            $this->name = pathinfo($this->getPath(), PATHINFO_FILENAME);
        }
    }

    /**
     * @return mixed
     */
    public function getUrl(){
        return $this->_url;
    }

    /**
     * @return mixed
     */
    public function getPath(){
        return $this->_path;
    }

    /**
     * @return mixed
     */
    public function getSize(){
        return $this->_size;
    }

    /**
     * @return mixed
     */
    public function getError(){
        return $this->_error;
    }

    /**
     * @param $path
     */
    public function setPath($path){
        $this->_path = $path;
    }

    /**
     * @param $url
     */
    public function setUrl($url){
        $this->_url = $url;
    }
} 