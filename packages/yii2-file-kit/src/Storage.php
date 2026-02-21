<?php
namespace trntv\filekit;

use Yii;
// Support both Flysystem 1.x and 2.x
if (interface_exists('League\Flysystem\FilesystemOperator')) {
    // Flysystem 2.x/3.x
    class_alias('League\Flysystem\FilesystemOperator', 'trntv\filekit\FilesystemInterface');
} else {
    // Flysystem 1.x
    class_alias('League\Flysystem\FilesystemInterface', 'trntv\filekit\FilesystemInterface');
}
use trntv\filekit\events\StorageEvent;
use trntv\filekit\filesystem\FilesystemBuilderInterface;
use yii\base\Component;
use yii\base\InvalidConfigException;
use yii\helpers\FileHelper;

/**
 * Class Storage
 * @package trntv\filekit
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Storage extends Component
{
    /**
     * Event triggered after delete
     */
    const EVENT_BEFORE_DELETE = 'beforeDelete';
    /**
     * Event triggered after save
     */
    const EVENT_BEFORE_SAVE = 'beforeSave';
    /**
     * Event triggered after delete
     */
    const EVENT_AFTER_DELETE = 'afterDelete';
    /**
     * Event triggered after save
     */
    const EVENT_AFTER_SAVE = 'afterSave';
    /**
     * @var
     */
    public $baseUrl;
    /**
     * @var
     */
    public $filesystemComponent;
    /**
     * @var
     */
    protected $filesystem;
    /**
     * Max files in directory
     * "-1" = unlimited
     * @var int
     */
    public $maxDirFiles = 65535; // Default: Fat32 limit
    /**
     * An array default config when save file.
     * It can be a callable for more flexible
     *
     * ```php
     * function (\trntv\filekit\File $fileObj) {
     *
     *      return ['ContentDisposition' => 'filename="' . $fileObj->getPathInfo('filename') . '"'];
     * }
     * ```
     *
     * @var array|callable
     * @since 2.0.2
     */
    public $defaultSaveConfig = [];
    /**
     * @var bool
     */
    public $useDirindex = true;
    /**
     * @var int
     */
    private $dirindex = 1;

    /**
     * @throws InvalidConfigException
     */
    public function init()
    {
        if ($this->baseUrl !== null) {
            $this->baseUrl = Yii::getAlias($this->baseUrl);
        }

        if ($this->filesystemComponent !== null) {
            $this->filesystem = Yii::$app->get($this->filesystemComponent);
        } else {
            $this->filesystem = Yii::createObject($this->filesystem);
            if ($this->filesystem instanceof FilesystemBuilderInterface) {
                $this->filesystem = $this->filesystem->build();
            }
        }
    }

    /**
     * @return FilesystemInterface
     * @throws InvalidConfigException
     */
    public function getFilesystem()
    {
        return $this->filesystem;
    }

    /**
     * @param $filesystem
     */
    public function setFilesystem($filesystem)
    {
        $this->filesystem = $filesystem;
    }

    /**
     * @param $file string|\yii\web\UploadedFile
     * @param bool $preserveFileName
     * @param bool $overwrite
     * @param array|callable $config
     * @param string $pathPrefix string path to save current file
     *
     * @return bool|string
     * @throws \League\Flysystem\FileExistsException
     * @throws \yii\base\Exception
     * @throws \yii\base\InvalidConfigException
     */
    public function save($file, $preserveFileName = false, $overwrite = false, $config = [], $pathPrefix = '')
    {
        $pathPrefix = FileHelper::normalizePath($pathPrefix);
        $fileObj = File::create($file);
        $dirIndex = $this->getDirIndex($pathPrefix);
        if ($preserveFileName === false) {
            do {
                $filename = implode('.', [
                    Yii::$app->security->generateRandomString(),
                    $fileObj->getExtension()
                ]);
                $path = implode(DIRECTORY_SEPARATOR, array_filter([$pathPrefix, $dirIndex, $filename]));
            } while ($this->getFilesystem()->has($path));
        } else {
            $filename = $fileObj->getPathInfo('filename');
            $path = implode(DIRECTORY_SEPARATOR, array_filter([$pathPrefix, $dirIndex, $filename]));
        }

        $this->beforeSave($fileObj->getPath(), $this->getFilesystem());

        $stream = fopen($fileObj->getPath(), 'r+');

        $defaultConfig = $this->defaultSaveConfig;

        if (is_callable($defaultConfig)) {
            $defaultConfig = call_user_func($defaultConfig, $fileObj);
        }

        if (is_callable($config)) {
            $config = call_user_func($config, $fileObj);
        }

        $config = array_merge(['ContentType' => $fileObj->getMimeType()], $defaultConfig, $config);

        if ($overwrite) {
            $success = $this->getFilesystem()->putStream($path, $stream, $config);
        } else {
            $success = $this->getFilesystem()->writeStream($path, $stream, $config);
        }

        if (is_resource($stream)) {
            fclose($stream);
        }

        if ($success) {
            $this->afterSave($path, $this->getFilesystem());
            return $path;
        }

        return false;
    }

    /**
     * @param $files array|\yii\web\UploadedFile[]
     * @param bool $preserveFileName
     * @param bool $overwrite
     * @param array $config
     * @return array
     */
    public function saveAll($files, $preserveFileName = false, $overwrite = false, array $config = [])
    {
        $paths = [];
        foreach ($files as $file) {
            $paths[] = $this->save($file, $preserveFileName, $overwrite, $config);
        }
        return $paths;
    }

    /**
     * @param $path
     * @return bool
     */
    public function delete($path)
    {
        if ($this->getFilesystem()->has($path)) {
            $this->beforeDelete($path, $this->getFilesystem());
            if ($this->getFilesystem()->delete($path)) {
                $this->afterDelete($path, $this->getFilesystem());
                return true;
            };
        }
        return false;
    }

    /**
     * @param $files
     */
    public function deleteAll($files)
    {
        foreach ($files as $file) {
            $this->delete($file);
        }

    }

    /**
     * @param string $path
     * @return false|int|string|null
     */
    protected function getDirIndex($path = '')
    {
        if (!$this->useDirindex) {
            return null;
        }
        $normalizedPath = '.dirindex';
        if (isset($path)) {
            $normalizedPath = $path . DIRECTORY_SEPARATOR . '.dirindex';
        }

        if (!$this->getFilesystem()->has($normalizedPath)) {
            $this->getFilesystem()->write($normalizedPath, (string)$this->dirindex);
        } else {
            $this->dirindex = $this->getFilesystem()->read($normalizedPath);
            if ($this->maxDirFiles !== -1) {
                $filesCount = count($this->getFilesystem()->listContents($this->dirindex));
                if ($filesCount > $this->maxDirFiles) {
                    $this->dirindex++;
                    $this->getFilesystem()->put($normalizedPath, (string)$this->dirindex);
                }
            }
        }

        return $this->dirindex;
    }

    /**
     * @param $path
     * @param null|\League\Flysystem\FilesystemInterface $filesystem
     * @throws InvalidConfigException
     */
    public function beforeSave($path, $filesystem = null)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_BEFORE_SAVE, $event);
    }

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function afterSave($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_AFTER_SAVE, $event);
    }

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function beforeDelete($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_BEFORE_DELETE, $event);
    }

    /**
     * @param $path
     * @param $filesystem
     * @throws InvalidConfigException
     */
    public function afterDelete($path, $filesystem)
    {
        /* @var \trntv\filekit\events\StorageEvent $event */
        $event = Yii::createObject([
            'class' => StorageEvent::className(),
            'path' => $path,
            'filesystem' => $filesystem
        ]);
        $this->trigger(self::EVENT_AFTER_DELETE, $event);
    }
}
