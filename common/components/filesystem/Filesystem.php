<?php

namespace common\components\filesystem;

use League\Flysystem\Config;
use League\Flysystem\Filesystem as BaseFilesystem;

/**
 * Compatibility shim for yii2-starter-kit/yii2-file-kit 2.2.0, which still passes
 * a League\Flysystem\Config instance to Filesystem::writeStream() even though
 * Flysystem 3 expects an array.
 *
 * Remove this class once the upstream package is fixed.
 */
class Filesystem extends BaseFilesystem
{
    public function writeStream(string $location, $contents, array|Config $config = []): void
    {
        parent::writeStream(
            $location,
            $contents,
            $config instanceof Config ? $config->toArray() : $config
        );
    }
}
