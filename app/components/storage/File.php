<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 2:00 PM
 */

namespace app\components\storage;


use yii\base\InvalidCallException;
use yii\base\Object;
use yii\validators\UrlValidator;
use yii\web\UploadedFile;

class File extends Object{

    public $is_stored = false;

    public $name;
    public $extension;

    private $_path;
    private $_url;
    private $_size;
    private $_error;

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

    public function init(){
        $this->_size = filesize($this->getPath());
        if(!$this->name){
            $this->name = pathinfo($this->getPath(), PATHINFO_FILENAME);
        }
    }

    public function getUrl(){
        return $this->_url;
    }

    public function getPath(){
        return $this->_path;
    }

    public function getSize(){
        return $this->_size;
    }

    public function getError(){
        return $this->_error;
    }

    public function setPath($path){
        if($this->_path) throw new InvalidCallException(
            get_class($this) . '::path already set'
        );
        $this->_path = $path;
    }
    public function setUrl($url){
        if($this->_url) throw new InvalidCallException(
            get_class($this) . '::url already set'
        );
        $this->_url = $url;
    }
} 