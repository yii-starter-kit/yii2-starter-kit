<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 *
 * @var $this     \yii\web\View
 * @var $provider \probe\provider\ProviderInterface
 */

use common\models\FileStorageItem;
use common\models\User;
use rmrevin\yii\fontawesome\FAS;

$this->title = Yii::t('backend', 'System Information');

$this->registerJs("window.paceOptions = { ajax: false }", \yii\web\View::POS_HEAD);
$this->registerJsFile(
    Yii::$app->request->baseUrl . 'js/system-information/index.js',
    [
        'depends' => [
            \yii\web\JqueryAsset::class,
            \common\assets\Flot::class,
            \yii\bootstrap4\BootstrapPluginAsset::class
        ]
    ]
);
?>

<div id="system-information-index">
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?php echo gmdate('H:i:s', $provider->getUptime()) ?>
                    </h3>
                    <p>
                        <?php echo Yii::t('backend', 'Uptime') ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('clock') ?>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-info">
                <div class="inner">
                    <h3>
                        <?php echo $provider->getLoadAverage() ?>
                    </h3>
                    <p>
                        <?php echo Yii::t('backend', 'Load average') ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('cogs') ?>
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-warning">
                <div class="inner">
                    <h3>
                        <?php echo User::find()->count() ?>
                    </h3>
                    <p>
                        <?php echo Yii::t('backend', 'User Registrations') ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('user-plus') ?>
                </div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/user/index']) ?>" class="small-box-footer">
                    <?php echo Yii::t('backend', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-danger">
                <div class="inner">
                    <h3>
                        <?php echo FileStorageItem::find()->count() ?>
                    </h3>
                    <p>
                        <?php echo Yii::t('backend', 'Files in storage') ?>
                    </p>
                </div>
                <div class="icon">
                    <?php echo FAS::icon('copy') ?>
                </div>
                <a href="<?php echo Yii::$app->urlManager->createUrl(['/file-storage/index']) ?>"
                   class="small-box-footer">
                    <?php echo Yii::t('backend', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>

    <div class="card-deck mb-3">

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Processor') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'Processor') ?></dt>
                    <dd><?php echo $provider->getCpuModel() ?></dd>

                    <dt><?php echo Yii::t('backend', 'Processor Architecture') ?></dt>
                    <dd><?php echo $provider->getArchitecture() ?></dd>

                    <dt><?php echo Yii::t('backend', 'Number of cores') ?></dt>
                    <dd><?php echo $provider->getCpuCores() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Operating System') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'OS') ?></dt>
                    <dd><?php echo $provider->getOsType() ?></dd>

                    <dt><?php echo Yii::t('backend', 'OS Release') ?></dt>
                    <dd><?php echo $provider->getOsRelease() ?></dd>

                    <dt><?php echo Yii::t('backend', 'Kernel version') ?></dt>
                    <dd><?php echo $provider->getOsKernelVersion() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>


        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Time') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'System Date') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asDate(time()) ?></dd>

                    <dt><?php echo Yii::t('backend', 'System Time') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asTime(time()) ?></dd>

                    <dt><?php echo Yii::t('backend', 'Timezone') ?></dt>
                    <dd><?php echo date_default_timezone_get() ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Network') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'Hostname') ?></dt>
                    <dd><?php echo $provider->getHostname() ?></dd>

                    <dt><?php echo Yii::t('backend', 'Internal IP') ?></dt>
                    <dd><?php echo $provider->getServerIP() ?></dd>

                    <dt><?php echo Yii::t('backend', 'External IP') ?></dt>
                    <dd><?php echo $provider->getExternalIP() ?></dd>

                    <dt><?php echo Yii::t('backend', 'Port') ?></dt>
                    <dd><?php echo $provider->getServerVariable('SERVER_PORT') ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Software') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'Web Server') ?></dt>
                    <dd><?php echo $provider->getServerSoftware() ?></dd>

                    <dt><?php echo Yii::t('backend', 'PHP Version') ?></dt>
                    <dd><?php echo $provider->getPhpVersion() ?></dd>

                    <dt><?php echo Yii::t('backend', 'DB Type') ?></dt>
                    <dd><?php echo $provider->getDbType(Yii::$app->db->pdo) ?></dd>

                    <dt><?php echo Yii::t('backend', 'DB Version') ?></dt>
                    <dd><?php echo $provider->getDbVersion(Yii::$app->db->pdo) ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>

        <div class="card card-primary">
            <div class="card-header">
                <i class="fa fa-hdd-o"></i>
                <h3 class="card-title"><?php echo Yii::t('backend', 'Memory') ?></h3>
            </div><!-- /.card-header -->
            <div class="card-body">
                <dl class="dl-horizontal">
                    <dt><?php echo Yii::t('backend', 'Total memory') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getTotalMem()) ?></dd>

                    <dt><?php echo Yii::t('backend', 'Free memory') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getFreeMem()) ?></dd>

                    <dt><?php echo Yii::t('backend', 'Total Swap') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getTotalSwap()) ?></dd>

                    <dt><?php echo Yii::t('backend', 'Free Swap') ?></dt>
                    <dd><?php echo Yii::$app->formatter->asSize($provider->getFreeSwap()) ?></dd>
                </dl>
            </div><!-- /.card-body -->
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="cpu-usage" class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo Yii::t('backend', 'CPU Usage') ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?php echo Yii::t('backend', 'Real time') ?>
                        <div class="realtime btn-group" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?php echo Yii::t('backend', 'On') ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?php echo Yii::t('backend', 'Off') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.card-body-->
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col">
            <div id="memory-usage" class="card card-primary">
                <div class="card-header">
                    <h3 class="card-title">
                        <?php echo Yii::t('backend', 'Memory Usage') ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?php echo Yii::t('backend', 'Real time') ?>
                        <div class="btn-group realtime" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?php echo Yii::t('backend', 'On') ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?php echo Yii::t('backend', 'Off') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.card-body-->
            </div>
        </div>
    </div>
</div>
