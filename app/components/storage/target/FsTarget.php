<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 2:02 PM
 */

namespace app\components\storage\target;

use app\components\storage\File;
use yii\base\InvalidConfigException;

class FsTarget extends Target{

    public $basePath;
    public $baseUrl;
    public $maxFiles = 65535; // Default: Fat32 limit

    private $_dirindex = 1;
    private $_dirmtime;
    private $_filescount;

    public function init(){
        if(!$this->basePath){
            throw new InvalidConfigException;
        }

        $this->basePath = \Yii::getAlias($this->basePath);
        $this->baseUrl = \Yii::getAlias($this->baseUrl);

        if(!file_exists($this->basePath.'/'.$this->getDirIndex())){
            mkdir($this->basePath.'/'.$this->getDirIndex());
        }

        if(!$this->baseUrl){
            $this->baseUrl = \Yii::getAlias('@webroot');
        }
    }

    public function getDirIndex(){
        if(!file_exists($this->basePath.'/index')){
            file_put_contents($this->basePath.'/index', $this->_dirindex);
        } else {
            $this->_dirindex = intval(file_get_contents($this->basePath.'/index'));
        }

        if(file_exists($this->basePath.'/'.$this->_dirindex)){
            if((count(scandir($this->basePath.'/'.$this->_dirindex)) - 2) > $this->maxFiles){
                $this->_dirindex++;
                file_put_contents($this->basePath.'/index', $this->_dirindex);
            }
        }
        return $this->_dirindex;
    }

    public function getFilesCount(){
        if (filemtime($this->basePath . '/' . $this->_dirindex) > $this->_dirmtime) {
            $this->_dirmtime = filemtime($this->basePath . '/' . $this->_dirindex);
            $this->_filescount = count(scandir($this->basePath . '/' . $this->_dirindex)) - 2;
        }
        return $this->_filescount;
    }



    public function save(File $file, $name = false)
    {
        if(!file_exists($this->basePath.'/'.$this->getDirIndex())){
            mkdir($this->basePath.'/'.$this->getDirIndex());
        }
        if(!$name){
            do{
                $name = sprintf('%s.%s', \Yii::$app->security->generateRandomKey(), $file->extension);
            } while(file_exists($name));
        }
        $basename = $this->getDirIndex().'/'.$name;
        if(rename($file->path, $this->basePath.'/'.$basename)){
            $file->is_stored = true;
            $file->url = $this->baseUrl.'/'.$basename;
        } else {
            $file->error = true;
        };
        return $file;
    }

    public function unlink(File $file)
    {
        return unlink($file->path);
    }
}