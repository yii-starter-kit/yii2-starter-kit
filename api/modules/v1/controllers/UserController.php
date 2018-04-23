<?php

namespace api\modules\v1\controllers;

use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\HttpBearerAuth;
use yii\filters\auth\HttpHeaderAuth;
use yii\filters\auth\QueryParamAuth;
use yii\rest\Controller;
use yii\rest\OptionsAction;

/**
 * @author Eugene Terentev <eugene@terentev.net>
 */
class UserController extends Controller
{
    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['authenticator'] = [
            'class' => CompositeAuth::class,
            'authMethods' => [
                HttpBasicAuth::class,
                HttpBearerAuth::class,
                HttpHeaderAuth::class,
                QueryParamAuth::class
            ]
        ];

        return $behaviors;
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'options' => [
                'class' => OptionsAction::class
            ]
        ];
    }

    /**
     * @return User|null|\yii\web\IdentityInterface
     */
    public function actionIndex()
    {
        $resource = new User();
        $resource->load(\Yii::$app->user->getIdentity()->attributes, '');
        return  $resource;
    }
}
