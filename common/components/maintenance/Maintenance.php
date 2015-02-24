<?php
namespace common\components\maintenance;
use yii\base\Component;
use yii\base\BootstrapInterface;

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
     * @var array
     * @see \yii\web\Application::catchAll
     */
    public $catchAll;

    public $retryAfter = 60;
    public $maintenanceLayout = '@common\components\maintenance\views\layouts\main.php';
    public $maintenanceView = '@common\components\maintenance\views\maintenance\index.php';
    public $maintenanceText = 'Down to maintenance';

    /**
     * Bootstrap method to be called during application bootstrap stage.
     * @param \yii\web\Application $app the application currently running
     */
    public function bootstrap($app)
    {
        if ($this->enabled instanceof \Closure) {
            $enabled = call_user_func($this->enabled, $app);
        } else {
            $enabled = $this->enabled;
        }
        if ($enabled) {
            if ($this->catchAll === null) {
                $app->controllerMap['maintenance'] = [
                    'class' => 'common\components\maintenance\controllers\MaintenanceController',
                    'retryAfter' => $this->retryAfter,
                    'maintenanceLayout' => $this->maintenanceLayout,
                    'maintenanceView' => $this->maintenanceView,
                    'maintenanceText' => $this->maintenanceText
                ];
                $app->catchAll = ['maintenance\index'];
            } else {
                $app->catchAll = $this->catchAll;
            }
        }
    }
}
