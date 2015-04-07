<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 * @var $this \yii\web\View
 * @var $provider \probe\provider\ProviderInterface
 */
use common\models\FileStorageItem;
use common\models\User;

$this->title = Yii::t('backend', 'System Information');
$this->registerJs("window.paceOptions = { ajax: false }", \yii\web\View::POS_HEAD);
$this->registerJsFile('/js/system-information/index.js', ['depends'=>['\yii\web\JqueryAsset', '\common\assets\Flot', '\yii\bootstrap\BootstrapPluginAsset']]) ?>
<div id="system-information-index">
    <div class="row connectedSortable">
        <div class="col-lg-6 col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Processor') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Processor') ?></dt>
                        <dd><?= $provider->getCpuModel() ?></dd>

                        <dt><?= Yii::t('backend', 'Processor Architecture') ?></dt>
                        <dd><?= $provider->getArchitecture() ?></dd>

                        <dt><?= Yii::t('backend', 'Number of cores') ?></dt>
                        <dd><?= $provider->getCpuCores() ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Operating System') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'OS') ?></dt>
                        <dd><?= $provider->getOsType() ?></dd>

                        <dt><?= Yii::t('backend', 'OS Release') ?></dt>
                        <dd><?= $provider->getOsRelease() ?></dd>

                        <dt><?= Yii::t('backend', 'Kernel version') ?></dt>
                        <dd><?= $provider->getOsKernelVersion() ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-3 col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Time') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'System Date') ?></dt>
                        <dd><?= Yii::$app->formatter->asDate(time()) ?></dd>

                        <dt><?= Yii::t('backend', 'System Time') ?></dt>
                        <dd><?= Yii::$app->formatter->asTime(time()) ?></dd>

                        <dt><?= Yii::t('backend', 'Timezone') ?></dt>
                        <dd><?= date_default_timezone_get() ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Network') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Hostname') ?></dt>
                        <dd><?= $provider->getHostname() ?></dd>

                        <dt><?= Yii::t('backend', 'Internal IP') ?></dt>
                        <dd><?= $provider->getServerIP() ?></dd>

                        <dt><?= Yii::t('backend', 'External IP') ?></dt>
                        <dd><?= $provider->getExternalIP() ?></dd>

                        <dt><?= Yii::t('backend', 'Port') ?></dt>
                        <dd><?= $provider->getServerIP('REMOTE_PORT') ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Software') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Web Server') ?></dt>
                        <dd><?= $provider->getServerSoftware() ?></dd>

                        <dt><?= Yii::t('backend', 'PHP Version') ?></dt>
                        <dd><?= $provider->getPhpVersion() ?></dd>

                        <dt><?= Yii::t('backend', 'DB Type') ?></dt>
                        <dd><?= $provider->getDbType(Yii::$app->db->pdo) ?></dd>

                        <dt><?= Yii::t('backend', 'DB Version') ?></dt>
                        <dd><?= $provider->getDbVersion(Yii::$app->db->pdo) ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-lg-4 col-md-6 col-sm-12">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Memory') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Total memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize($provider->getTotalMem()) ?></dd>

                        <dt><?= Yii::t('backend', 'Free memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize($provider->getFreeMem()) ?></dd>

                        <dt><?= Yii::t('backend', 'Total Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize($provider->getTotalSwap()) ?></dd>

                        <dt><?= Yii::t('backend', 'Free Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize($provider->getFreeSwap()) ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-green">
                <div class="inner">
                    <h3>
                        <?= gmdate('H:i:s', $provider->getUptime()) ?>
                    </h3>
                    <p>
                        <?= Yii::t('backend', 'Uptime') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="fa fa-clock-o"></i>
                </div>
                <div class="small-box-footer">
                    &nbsp;
                </div>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-aqua">
                <div class="inner">
                    <h3>
                        <?= $provider->getLoadAverage() ?>
                    </h3>
                    <p>
                        <?= Yii::t('backend', 'Load average') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-bag"></i>
                </div>
                <div class="small-box-footer">
                    &nbsp;
                </div>
            </div>
        </div><!-- ./col -->

        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-yellow">
                <div class="inner">
                    <h3>
                        <?= User::find()->count() ?>
                    </h3>
                    <p>
                        <?= Yii::t('backend', 'User Registrations') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-person-add"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl(['/user/index']) ?>" class="small-box-footer">
                    <?= Yii::t('backend', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
        <div class="col-lg-3 col-xs-6">
            <!-- small box -->
            <div class="small-box bg-red">
                <div class="inner">
                    <h3>
                        <?= FileStorageItem::find()->count() ?>
                    </h3>
                    <p>
                        <?= Yii::t('backend', 'Files in storage') ?>
                    </p>
                </div>
                <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                </div>
                <a href="<?= Yii::$app->urlManager->createUrl(['/file-storage/index']) ?>" class="small-box-footer">
                    <?= Yii::t('backend', 'More info') ?> <i class="fa fa-arrow-circle-right"></i>
                </a>
            </div>
        </div><!-- ./col -->
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="cpu-usage" class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('backend', 'CPU Usage') ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?= Yii::t('backend', 'Real time') ?>
                        <div class="realtime btn-group" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?= Yii::t('backend', 'On') ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?= Yii::t('backend', 'Off') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.box-body-->
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-12">
            <div id="memory-usage" class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">
                        <?= Yii::t('backend', 'Memory Usage') ?>
                    </h3>
                    <div class="box-tools pull-right">
                        <?= Yii::t('backend', 'Real time') ?>
                        <div class="btn-group realtime" data-toggle="btn-toggle">
                            <button type="button" class="btn btn-default btn-xs active" data-toggle="on">
                                <?= Yii::t('backend', 'On') ?>
                            </button>
                            <button type="button" class="btn btn-default btn-xs" data-toggle="off">
                                <?= Yii::t('backend', 'Off') ?>
                            </button>
                        </div>
                    </div>
                </div>
                <div class="box-body">
                    <div class="chart" style="height: 300px;">
                    </div>
                </div><!-- /.box-body-->
            </div>
        </div>
    </div>
</div>