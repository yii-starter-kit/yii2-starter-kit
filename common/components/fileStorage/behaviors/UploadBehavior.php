<?php
/**
 * @copyright Copyright (c) 2014 Eugine terentev
 * @license http://opensource.org/licenses/MIT
 */

namespace common\components\fileStorage\behaviors;

use Yii;
use yii\base\Behavior;
use yii\web\UploadedFile;
use yii\db\ActiveRecord;

/**
 *
 * Example:
 *
 * ```php
 * public function behaviors()
 * {
 *      return [
 *          'file' => [
 *              'class' => UploadBehavior::className(),
 *              'attribute' => 'path',
 *              'fileCategory' => 'products',
 *              'fileRepository' => 'filesystem',
 *              'fileProcessing'=>function($file, $uploadAction){
 *                  // resize etc
 *              }
 *          ],
 *      ];
 * }
 * ```
 *
 */
class UploadBehavior extends Behavior
{
    public $attribute;

    public $fileCategory;
    public $fileRepository;

    /***
     * @var \Closure
     * ```php
     * function($file) {
     *     // process file value
     * }
     * ```
     */
    public $fileProcessing;

    /**
     * @var \yii\web\UploadedFile
     */
    private $_uploadedFile;

    public function events()
    {
        return [
            ActiveRecord::EVENT_BEFORE_INSERT => 'beforeInsert',
            ActiveRecord::EVENT_BEFORE_UPDATE => 'beforeUpdate',
            ActiveRecord::EVENT_AFTER_DELETE => 'afterDelete',
            ActiveRecord::EVENT_BEFORE_VALIDATE => 'beforeValidate',
        ];
    }

    public function beforeValidate()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $this->_uploadedFile = UploadedFile::getInstance($model, $this->attribute);
        if ($this->_uploadedFile && !$this->_uploadedFile->hasError) {
            $this->owner->setAttribute($this->attribute, $this->_uploadedFile);
        }
    }

    public function beforeInsert()
    {
        if($this->_uploadedFile && !$this->_uploadedFile->hasError) {
            $this->_save();
        }
    }

    public function beforeUpdate()
    {
        if($this->_uploadedFile && !$this->_uploadedFile->hasError) {
            $this->_save();
        }
    }

    public function afterDelete()
    {
        $this->_delete();
    }

    private function _save()
    {
        /** @var ActiveRecord $model */
        $model = $this->owner;
        $file = Yii::$app->fileStorage->save($model->getAttribute($this->attribute), $this->fileCategory, $this->fileRepository);
        if(!$file->error) {
            if ($this->fileProcessing instanceof \Closure) {
                call_user_func($this->fileProcessing, $file);
            }
            // delete the old version if it necessary
            $this->_delete();
            $model->setAttribute($this->attribute, $file->url);
        }
    }

    private function _delete()
    {
        Yii::$app->fileStorage->delete($this->owner->getOldAttribute($this->attribute));
    }
}