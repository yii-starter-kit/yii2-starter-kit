<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 8/3/14
 * Time: 8:20 PM
 */
namespace common\components\fileStorage\repository;

use common\components\fileStorage\File;
use common\models\FileStorageItem;
use Exception;
use yii\base\Component;
use yii\base\InvalidConfigException;

abstract class BaseRepository extends Component{

    const EVENT_AFTER_DELETE = 'afterDelete';
    const EVENT_AFTER_SAVE = 'afterSave';

    public function init(){
        if(!$this->name){
            throw new InvalidConfigException(\Yii::t('common', 'Name cannot be empty'));
        }
    }

    public function afterSave($file){
        if(!$file->error) {
            $model = new FileStorageItem();
            $model->repository = $this->name;
            $model->url = $file->url;
            $model->path = $file->path;
            $model->size = $file->size;
            $model->mimeType = $file->mimeType;
            $model->status = FileStorageItem::STATUS_UPLOADED;
            if(!$model->save()){
                throw new Exception;
            };
        }
        $this->trigger(self::EVENT_AFTER_SAVE);
    }

    public function afterDelete($file){
        $model = FileStorageItem::findOne(['path'=>$file->path]);
        if($model){
            $model->status = FileStorageItem::STATUS_DELETED;
            $model->save(false);
        }
        $this->trigger(self::EVENT_AFTER_DELETE);
    }

    abstract public function save(File $file);
    abstract public function delete(File $file);
    abstract public function reset();
}