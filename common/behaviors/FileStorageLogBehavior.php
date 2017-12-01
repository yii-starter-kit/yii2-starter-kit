<?php

namespace common\behaviors;

use common\models\FileStorageItem;
use League\Flysystem\File;
use trntv\filekit\Storage;
use Yii;
use yii\base\Behavior;
use yii\base\InvalidConfigException;

/**
 * Class FileStorageLogBehavior
 * @package common\behaviors
 * @author Eugene Terentev <eugene@terentev.net>
 */
class FileStorageLogBehavior extends Behavior
{
    public $component;

    public function events()
    {
        return [
            Storage::EVENT_AFTER_SAVE => 'afterSave',
            Storage::EVENT_AFTER_DELETE => 'afterDelete'
        ];
    }

    /**
     * @param $event \trntv\filekit\events\StorageEvent
     */
    public function afterSave($event)
    {
        $file = new File($event->filesystem, $event->path);
        $model = new FileStorageItem();
        $model->component = $this->component;
        $model->path = $file->getPath();
        $model->base_url = $this->getStorage()->baseUrl;
        $model->size = $file->getSize();
        $model->type = $file->getMimeType();
        $model->name = pathinfo($file->getPath(), PATHINFO_FILENAME);
        if (Yii::$app->request->getIsConsoleRequest() === false) {
            $model->upload_ip = Yii::$app->request->getUserIP();
        }
        $model->save(false);
    }

    /**
     * @return \trntv\filekit\Storage
     * @throws \yii\base\InvalidConfigException
     */
    public function getStorage()
    {
        if ($this->component === null) {
            throw new InvalidConfigException('Storage component name must be set');
        }
        return Yii::$app->get($this->component);
    }

    /**
     * @param $event \trntv\filekit\events\StorageEvent
     */
    public function afterDelete($event)
    {
        FileStorageItem::deleteAll([
            'component' => $this->component,
            'path' => $event->path
        ]);
    }
}
