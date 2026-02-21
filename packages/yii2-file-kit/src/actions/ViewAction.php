<?php

namespace trntv\filekit\actions;

use yii\web\HttpException;

/**
 * Class ViewAction
 * @package trntv\filekit\actions
 * @author Eugene Terentev <eugene@terentev.net>
 */
class ViewAction extends BaseAction
{
    /**
     * @var string path request param
     */
    public $pathParam = 'path';
    /**
     * @var boolean, whether the browser should open the file within the browser window. Defaults to false,
     * meaning a download dialog will pop up.
     */
    public $inline = false;

    /**
     * @return static
     * @throws HttpException
     * @throws \HttpException
     */
    public function run()
    {
        $path = \Yii::$app->request->get($this->pathParam);
        $filesystem = $this->getFileStorage()->getFilesystem();
        if ($filesystem->has($path) === false) {
            throw new HttpException(404);
        }
        return \Yii::$app->response->sendStreamAsFile(
            $filesystem->readStream($path),
            pathinfo($path, PATHINFO_BASENAME),
            [
                'mimeType' => $filesystem->getMimetype($path),
                'inline' => $this->inline
            ]
        );
    }
}
