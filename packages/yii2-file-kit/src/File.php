<?php
namespace trntv\filekit;

use yii\base\InvalidConfigException;
use yii\base\InvalidParamException;
use yii\base\BaseObject;
use yii\helpers\FileHelper;
use yii\web\UploadedFile;

/**
 * Class File
 * @package trntv\filekit
 * @author Eugene Terentev <eugene@terentev.net>
 */
class File extends BaseObject
{
    /**
     * @var
     */
    protected $path;
    /**
     * @var
     */
    protected $extension;
    /**
     * @var
     */
    protected $size;
    /**
     * @var
     */
    protected $mimeType;

    /**
     * @var
     */
    protected $pathinfo;

    /**
     * @param $file string|\yii\web\UploadedFile
     * @return self
     * @throws InvalidConfigException
     */
    public static function create($file)
    {

        if (is_a($file, self::className())) {
            return $file;
        }

        // UploadedFile
        if (is_a($file, UploadedFile::className())) {
            if ($file->error) {
                throw new InvalidParamException("File upload error \"{$file->error}\"");
            }
            return \Yii::createObject([
                'class'=>self::className(),
                'path'=>$file->tempName,
                'extension'=>$file->getExtension()
            ]);
        } // Path
        else {
            return \Yii::createObject([
                'class' => self::className(),
                'path' => FileHelper::normalizePath($file)
            ]);
        }
    }

    /**
     * @param array $files
     * @return self[]
     * @throws \yii\base\InvalidConfigException
     */
    public static function createAll(array $files)
    {
        $result = [];
        foreach ($files as $file) {
            $result[] = self::create($file);
        }
        return $result;
    }

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->path === null) {
            throw new InvalidConfigException;
        }
    }

    /**
     * @return mixed
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * @return mixed
     */
    public function getSize()
    {
        if (!$this->size) {
            $this->size = filesize($this->path);
        }
        return $this->size;
    }

    /**
     * @return string
     * @throws InvalidConfigException
     */
    public function getMimeType()
    {
        if (!$this->mimeType) {
            $this->mimeType = FileHelper::getMimeType($this->path);
        }
        return $this->mimeType;
    }

    /**
     * @return mixed|null
     */
    public function getExtension()
    {
        if ($this->extension === null) {
            $this->extension = $this->getPathInfo('extension');
        }
        return $this->extension;
    }

    /**
     * @return mixed
     */
    public function getExtensionByMimeType()
    {
        $extensions = FileHelper::getExtensionsByMimeType($this->getMimeType());
        return array_shift($extensions);
    }

    /**
     * @param bool $part
     * @return mixed|null
     */
    public function getPathInfo($part = false)
    {
        if ($this->pathinfo === null) {
            $this->pathinfo = pathinfo($this->path);
        }
        if ($part !== false) {
            return array_key_exists($part, $this->pathinfo) ? $this->pathinfo[$part] : null;
        }
        return $this->pathinfo;
    }

    /**
     * @param $path
     */
    public function setPath($path)
    {
        $this->path = $path;
    }

    /**
     * @param $extension
     */
    public function setExtension($extension)
    {
        $this->extension = $extension;
    }

    /**
     * @return bool
     */
    public function hasErrors()
    {
        return $this->error !== false;
    }
}
