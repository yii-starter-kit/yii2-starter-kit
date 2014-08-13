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

/**
 * Class BaseRepository
 * @package common\components\fileStorage\repository
 */
abstract class BaseRepository extends Component{

    /**
     * Event triggered after delete
     */
    const EVENT_AFTER_DELETE = 'afterDelete';
    /**
     * Event triggered after save
     */
    const EVENT_AFTER_SAVE = 'afterSave';

    /**
     * @throws \yii\base\InvalidConfigException
     */
    public function init(){
        if(!$this->name){
            throw new InvalidConfigException(\Yii::t('common', 'Name cannot be empty'));
        }
    }

    /**
     * This method is called at the end saving a file.
     * Method creates a record about saved file to db
     * @param $file
     * @param null $category
     * @throws \Exception
     */
    public function afterSave($file, $category = null){
        if(!$file->error) {
            $model = new FileStorageItem();
            $model->repository = $this->name;
            $model->category = $category;
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

    /**
     * @param $file
     */
    public function afterDelete($file){
        $model = FileStorageItem::findOne(['path'=>$file->path, 'repository'=>$this->name]);
        if($model){
            $model->status = FileStorageItem::STATUS_DELETED;
            $model->save(false);
        }
        $this->trigger(self::EVENT_AFTER_DELETE);
    }

    /**
     * @param File $file
     * @return mixed
     */
    public function delete(File $file){
        $this->afterDelete($file);
    }

    /**
     * @param File $file
     * @param $category
     * @return mixed
     */
    public function save(File $file, $category = null){
        $this->afterSave($file, $category);
    }

    /**
     * @return mixed
     */
    abstract public function reset();
}