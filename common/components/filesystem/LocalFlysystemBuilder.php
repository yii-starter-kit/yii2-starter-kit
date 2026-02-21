<?php

namespace common\components\filesystem;

use League\Flysystem\Filesystem;
use trntv\filekit\filesystem\FilesystemBuilderInterface;

/**
 * Class LocalFlysystemProvider
 * @author Eugene Terentev <eugene@terentev.net>
 */
class LocalFlysystemBuilder implements FilesystemBuilderInterface
{
    public $path;

    public function build()
    {
        $resolvedPath = \Yii::getAlias($this->path);
        
        // Check if we're using Flysystem 2.x or 1.x
        if (class_exists('League\Flysystem\Local\LocalFilesystemAdapter')) {
            // Flysystem 2.x
            $adapter = new \League\Flysystem\Local\LocalFilesystemAdapter($resolvedPath);
        } else {
            // Flysystem 1.x
            $adapter = new \League\Flysystem\Adapter\Local($resolvedPath);
        }
        
        return new Filesystem($adapter);
    }
}
