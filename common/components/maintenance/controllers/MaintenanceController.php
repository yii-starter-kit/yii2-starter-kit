<?php

namespace common\components\maintenance\controllers;

use Yii;
use yii\web\Controller;

/**
 * Class MaintenanceController
 * @author Eugene Terentev <eugene@terentev.net>
 */
class MaintenanceController extends Controller
{
    /**
     * @var int
     */
    public $statusCode = 503;
    /**
     * @var int
     */
    public $retryAfter;
    /**
     * @var string|null
     */
    public $maintenanceLayout;
    /**
     * @var string|null
     */
    public $maintenanceView;
    /**
     * @var string|null
     */
    public $maintenanceText;

    /**
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = $this->maintenanceLayout;

        Yii::$app->response->statusCode = $this->statusCode;
        Yii::$app->response->headers->set('Retry-After', $this->retryAfter);

        return $this->render($this->maintenanceView, [
            'maintenanceText' => $this->maintenanceText,
            'retryAfter' => $this->retryAfter
        ]);
    }
}
