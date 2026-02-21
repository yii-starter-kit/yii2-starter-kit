<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:20 PM
 */

namespace trntv\filekit\actions;

use yii\web\HttpException;
use League\Flysystem\FilesystemInterface;
use trntv\filekit\events\UploadEvent;
use League\Flysystem\File as FlysystemFile;

/**
 * public function actions(){
 *   return [
 *           'upload'=>[
 *               'class'=>'trntv\filekit\actions\DeleteAction',
 *               'on afterDelete' => function($event) {
 *                   $file = $event->file;
 *                   $thumb_path = Yii::getAlias('@storage/web/source/thumb/') . $file->getPath();
 *                   unlink($thumb_path);
 *              }
 *           ]
 *       ];
 *   }
 */
class DeleteAction extends BaseAction
{
    const EVENT_AFTER_DELETE = 'afterDelete';
    /**
     * @var string path request param
     */
    public $pathParam = 'path';
    /**
     * @return bool
     * @throws HttpException
     * @throws \HttpException
     */
    public function run()
    {
        $path = \Yii::$app->request->get($this->pathParam);
        $paths = \Yii::$app->session->get($this->sessionKey, []);
        if (in_array($path, $paths, true)) {
            $success = $this->getFileStorage()->delete($path);
            if (!$success) {
                throw new HttpException(400);
            } else {
                $this->afterDelete($path);
            }
            return $success;
        } else {
            throw new HttpException(403);
        }
    }
    
    /**
     * @param $path
     */
    public function afterDelete($path)
    {
        $file = null;
        $fs = $this->getFileStorage()->getFilesystem();
        if ($fs instanceof FilesystemInterface) {
            $file = new FlysystemFile($fs, $path);
        }
        $this->trigger(self::EVENT_AFTER_DELETE, new UploadEvent([
            'path' => $path,
            'filesystem' => $fs,
            'file' => $file
        ]));
    }
}
