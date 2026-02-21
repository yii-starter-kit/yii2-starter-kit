<?php
namespace trntv\filekit\actions;

use League\Flysystem\FilesystemInterface;
use trntv\filekit\events\UploadEvent;
use League\Flysystem\File as FlysystemFile;
use Yii;
use yii\base\DynamicModel;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\web\Response;
use yii\web\UploadedFile;

/**
* Class UploadAction
* public function actions(){
*   return [
*           'upload'=>[
*               'class'=>'trntv\filekit\actions\UploadAction',
*           ]
*       ];
*   }
*/
class UploadAction extends BaseAction
{

    const EVENT_AFTER_SAVE = 'afterSave';

    /**
     * @var string
     */
    public $fileparam = 'file';

    /**
     * @var bool
     */
    public $multiple = true;

    /**
     * @var bool
     */
    public $disableCsrf = true;

    /**
     * @var string
     */
    public $responseFormat = Response::FORMAT_JSON;
    /**
     * @var string
     */
    public $responsePathParam = 'path';
    /**
     * @var string
     */
    public $responseBaseUrlParam = 'base_url';
    /**
     * @var string
     */
    public $responseUrlParam = 'url';
    /**
     * @var string
     */
    public $responseDeleteUrlParam = 'delete_url';
    /**
     * @var string
     */
    public $responseMimeTypeParam = 'type';
    /**
     * @var string
     */
    public $responseNameParam = 'name';
    /**
     * @var string
     */
    public $responseSizeParam = 'size';
    /**
     * @var string
     */
    public $deleteRoute = 'delete';

    /**
     * @var array
     * @see https://github.com/yiisoft/yii2/blob/master/docs/guide/input-validation.md#ad-hoc-validation-
     */
    public $validationRules;

    /**
     * @var string path where files would be stored
     */
    public $uploadPath = '';

    /**
     * An array config when save file.
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
    public $saveConfig = [];

    /**
     *
     */
    public function init()
    {
        \Yii::$app->response->format = $this->responseFormat;

        if (\Yii::$app->request->get('fileparam')) {
            $this->fileparam = \Yii::$app->request->get('fileparam');
        }

        if (\Yii::$app->request->get('upload-path')) {
            $this->uploadPath = \Yii::$app->request->get('upload-path');
        }

        if ($this->disableCsrf) {
            \Yii::$app->request->enableCsrfValidation = false;
        }
    }

    /**
     * @return array
     * @throws \HttpException
     */
    public function run()
    {
        $result = [];
        $uploadedFiles = UploadedFile::getInstancesByName($this->fileparam);

        foreach ($uploadedFiles as $uploadedFile) {
            /* @var \yii\web\UploadedFile $uploadedFile */
            $output = [
                $this->responseNameParam => Html::encode($uploadedFile->name),
                $this->responseMimeTypeParam => $uploadedFile->type,
                $this->responseSizeParam => $uploadedFile->size,
                $this->responseBaseUrlParam =>  $this->getFileStorage()->baseUrl
            ];
            if ($uploadedFile->error === UPLOAD_ERR_OK) {
                $validationModel = DynamicModel::validateData(['file' => $uploadedFile], $this->validationRules);
                if (!$validationModel->hasErrors()) {
                    $path = $this->getFileStorage()->save($uploadedFile, false, false, $this->saveConfig, $this->uploadPath);

                    if ($path) {
                        $output[$this->responsePathParam] = $path;
                        $output[$this->responseUrlParam] = $this->getFileStorage()->baseUrl . '/' . $path;
                        $output[$this->responseDeleteUrlParam] = Url::to([$this->deleteRoute, 'path' => $path]);
                        $paths = \Yii::$app->session->get($this->sessionKey, []);
                        $paths[] = $path;
                        \Yii::$app->session->set($this->sessionKey, $paths);
                        $this->afterSave($path);

                    } else {
                        $output['error'] = true;
                        $output['errors'] = [];
                    }

                } else {
                    $output['error'] = true;
                    $output['errors'] = $validationModel->getFirstError('file');
                }
            } else {
                $output['error'] = true;
                $output['errors'] = $this->resolveErrorMessage($uploadedFile->error);
            }

            $result['files'][] = $output;
        }
        return $this->multiple ? $result : array_shift($result);
    }

    /**
     * @param $path
     */
    public function afterSave($path)
    {
        $file = null;
        $fs = $this->getFileStorage()->getFilesystem();
        if ($fs instanceof FilesystemInterface) {
            $file = new FlysystemFile($fs, $path);
        }
        $this->trigger(self::EVENT_AFTER_SAVE, new UploadEvent([
            'path' => $path,
            'filesystem' => $fs,
            'file' => $file
        ]));
    }

    protected function resolveErrorMessage($value)
    {
        switch ($value) {
            case UPLOAD_ERR_OK:
                return false;
                break;
            case UPLOAD_ERR_INI_SIZE:
                $message = 'The uploaded file exceeds the upload_max_filesize directive in php.ini.';
                break;
            case UPLOAD_ERR_FORM_SIZE:
                $message = 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form.';
                break;
            case UPLOAD_ERR_PARTIAL:
                $message = 'The uploaded file was only partially uploaded.';
                break;
            case UPLOAD_ERR_NO_FILE:
                $message = 'No file was uploaded.';
                break;
            case UPLOAD_ERR_NO_TMP_DIR:
                $message = 'Missing a temporary folder.';
                break;
            case UPLOAD_ERR_CANT_WRITE:
                $message = 'Failed to write file to disk.';
                break;
            case UPLOAD_ERR_EXTENSION:
                $message = 'A PHP extension stopped the file upload.';
                break;
            default:
                return null;
                break;
        }
        return $message;
    }
}
