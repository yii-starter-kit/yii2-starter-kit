<?php
/**
 * Created by PhpStorm.
 * User: zein
 * Date: 7/13/14
 * Time: 1:20 PM
 */

namespace common\components\fileStorage\action;

use yii\base\Action;

/**
 * public function actions(){
 *   return [
 *           'upload'=>[
 *               'class'=>'common\components\fileStorage\action\DeleteAction',
 *               'fileparam'=>'path',
 *               'repositoryparam'=>'repository',
 *           ]
 *       ];
 *   }
 */
class DeleteAction extends Action{

    public $fileparam = 'path';
    public $repositoryparam = 'repository';

    public function run()
    {
        return \Yii::$app->fileStorage->delete(
            \Yii::$app->request->get($this->fileparam),
            \Yii::$app->request->get($this->repositoryparam)
        );
    }
} 