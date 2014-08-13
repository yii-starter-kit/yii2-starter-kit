<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 2:00 PM
 */
namespace common\components\fileStorage;

use yii\base\InvalidCallException;
use yii\base\Object;
use yii\web\UploadedFile;

/**
 * Class File
 * @package common\components\storage
 */
class File extends Object
{
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
    public $path;

    /**
     * @var file web accessible address
     */
    public $url;

    /**
     * @var error
     */
    public $error;

    /**
     * @var filesize
     */
    private $_size;

    /**
     * @var file mimeType
     */
    private $_mimeType;

    /**
     * Init file
     */
    public function init(){
        if(!$this->name){
            $this->name = pathinfo($this->path, PATHINFO_FILENAME);
        }
        if(!$this->path){
            throw new InvalidCallException;
        }
    }

    /**
     * @return mixed
     */
    public function getSize(){
        if(!$this->_size){
            $this->_size = filesize($this->path);
        }
        return $this->_size;
    }

    public function getMimeType(){
        if(!$this->_mimeType){
            $this->_mimeType = @mime_content_type($this->path);
        }
        return $this->_mimeType;
    }

    /**
     * @param $file
     * @return object
     * @throws \yii\base\InvalidConfigException
     */
    public static function load($file){

        if(!$file){
            return false;
        }

        if(is_a($file, self::className())){
            return $file;
        }

        // UploadedFile
        if(is_a($file, UploadedFile::className())){
            return \Yii::createObject([
                'class'=>self::className(),
                'path'=>$file->tempName,
                'extension'=>$file->getExtension()
            ]);
        }

        // Url
        elseif(strpos($file, 'http://') === 0 || strpos($file, 'https://') === 0){
            return \Yii::createObject([
                'class'=>self::className(),
                'path'=>\Yii::$app->storage->download($file),
                'extension'=>pathinfo($file, PATHINFO_EXTENSION)
            ]);
        }

        // Path
        else {
            return \Yii::createObject([
                'class' => self::className(),
                'path' => realpath($file),
                'extension' => pathinfo($file, PATHINFO_EXTENSION)
            ]);
        }
    }

    /**
     * @param array $files
     * @return array
     */
    public static function loadMulti(array $files){
        $result = [];
        foreach($files as $file){
            $result[] = self::load($file);
        }
        return $result;
    }
}