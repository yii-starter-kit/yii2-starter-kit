<?php

namespace common\components\maintenance;

use common\components\maintenance\controllers\MaintenanceController;
use Yii;
use yii\base\BootstrapInterface;
use yii\base\Component;

/**
 * Class Maintenance
 * @author Eugene Terentev <eugene@terentev.net>
 */
class Maintenance extends Component implements BootstrapInterface
{
    /**
     * @var boolean|\Closure boolean value or Closure that return
     * boolean indicating if app in maintenance mode or not
     */
    public $enabled;
    /**
     * @var string
     * @see \yii\web\Application::catchAll
     */
    public $catchAllRoute;
    /**
     * @var int
     */
    public $statusCode = 503;
    /**
     * @var mixed
     * @link http://www.w3.org/Protocols/rfc2616/rfc2616-sec14.html#sec14.37
     */
    public $retryAfter = 300;
    /**
     * @var string
     */
    public $maintenanceLayout = '@common/components/maintenance/views/layouts/main.php';
    /**
     * @var string
     */
    public $maintenanceView = '@common/components/maintenance/views/maintenance/index.php';
    /**
     * @var string
     */
    public $maintenanceText;

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\web\Application $app the application currently running
     * @throws \yii\base\InvalidConfigException
     */
    public function bootstrap($app)
    {
        if ($this->enabled instanceof \Closure) {
            $enabled = \call_user_func($this->enabled, $app);
        } else {
            $enabled = $this->enabled;
        }
        if ($enabled) {
            $this->maintenanceText = $this->maintenanceText ?: Yii::t('common', 'Down to maintenance.');
            if ($this->catchAllRoute === null) {
                $app->controllerMap['maintenance'] = [
                    'class' => MaintenanceController::class,
                    'statusCode' => $this->statusCode,
                    'retryAfter' => $this->retryAfter,
                    'maintenanceLayout' => $this->maintenanceLayout,
                    'maintenanceView' => $this->maintenanceView,
                    'maintenanceText' => $this->maintenanceText
                ];
                $app->catchAll = ['maintenance/index'];
                Yii::$app->view->registerAssetBundle(MaintenanceAsset::class);
            } else {
                $app->catchAll = [
                    $this->catchAllRoute,
                    'retryAfter' => $this->retryAfter,
                    'maintenanceText' => $this->maintenanceText
                ];
            }
        }
    }
}
