<?php
namespace backend\controllers\user;
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
use dektrium\user\controllers\SecurityController as BaseSecurityController;
use Yii;
use yii\web\Response;
use dektrium\user\models\LoginForm;
/**
 * Description of SecurityController
 *
 * @author HP
 */
class SecurityController extends BaseSecurityController{
    
    /**
     * Displays the login page.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        $this->layout = '@backend/views/layouts/base';
        
        if (!Yii::$app->user->isGuest) {
            $this->goHome();
        }

        /** @var LoginForm $model */
        $model = Yii::createObject(LoginForm::className());
        $event = $this->getFormEvent($model);

        $this->performAjaxValidation($model);
        $this->trigger(self::EVENT_BEFORE_LOGIN, $event);

        if ($model->load(Yii::$app->getRequest()->post()) && $model->login()) {
            $this->trigger(self::EVENT_AFTER_LOGIN, $event);
            return $this->goBack();
        }

        return $this->render('login', [
            'model'  => $model,
            'module' => $this->module,
        ]);
    }
}