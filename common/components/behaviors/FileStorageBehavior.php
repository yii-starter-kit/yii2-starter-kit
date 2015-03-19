<?php
namespace common\components\behaviors;
use yii\base\Behavior;
use trntv\filekit\Storage;
use common\models\FileStorageItem;

/**
 * Class FileStorageBehavior
 * @package common\components\behaviors
 * @author Eugene Terentev <eugene@terentev.net>
 */
class FileStorageBehavior extends Behavior
{
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
        $model = new FileStorageItem();
        //$model->component = $this->owner->
        $model->path = $event->file->getPath();
    }

    public function afterDelete($event)
    {

    }
}
