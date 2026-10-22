<?php

namespace common\components\filesystem;

use League\Flysystem\Local\LocalFilesystemAdapter;
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
        return new Filesystem(new LocalFilesystemAdapter(\Yii::getAlias($this->path)));
    }
}
