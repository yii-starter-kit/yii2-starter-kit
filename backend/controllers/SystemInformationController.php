<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 */

namespace backend\controllers;


use trntv\systeminfo\SystemInfo;
use yii\web\Controller;
use yii\web\Response;

class SystemInformationController extends Controller{
    public function actionIndex(){
        if(\Yii::$app->request->isAjax){
            \Yii::$app->response->format = Response::FORMAT_JSON;
            if($key = \Yii::$app->request->get('data')){
                switch($key){
                    case 'cpu_usage':
                        return SystemInfo::getCpuUsage(1);
                        break;
                    case 'memory_usage':
                        return (SystemInfo::getTotalMem() - SystemInfo::getFreeMem()) / SystemInfo::getTotalMem();
                        break;
                }
            }
        } else {
            return $this->render('index');
        }
    }
} 