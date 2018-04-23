<?php

namespace api\modules\v1;

use Yii;
use yii\filters\ContentNegotiator;
use yii\filters\RateLimiter;
use yii\web\Response;

class Module extends \yii\base\Module
{
    /** @var string */
    public $controllerNamespace = 'api\modules\v1\controllers';

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        Yii::$app->user->identityClass = 'api\modules\v1\models\ApiUserIdentity';
        Yii::$app->user->enableSession = false;
        Yii::$app->user->loginUrl = null;
    }

    /**
     * @return array
     */
    public function behaviors()
    {
        $behaviors = parent::behaviors();

        $behaviors['contentNegotiator'] = [
            'class' => ContentNegotiator::class,
            'formats' => [
                'application/json' => Response::FORMAT_JSON,
                'application/xml' => Response::FORMAT_XML,
            ],
        ];

        $behaviors['rateLimiter'] = [
            'class' => RateLimiter::class,
        ];

        return $behaviors;
    }
}
