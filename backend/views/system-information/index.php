<?php
/**
 * Author: Eugine Terentev <eugine@terentev.net>
 * @var $this \yii\web\View
 */
use common\models\User;
use trntv\systeminfo\SystemInfo;

$this->title = Yii::t('backend', 'System Information');
\common\assets\Flot::register($this);
$this->registerJsFile('/js/system-information/index.js', ['depends'=>['\yii\web\JqueryAsset', '\common\assets\Flot', '\yii\bootstrap\BootstrapPluginAsset']]) ?>
<div id="system-information-index">
    <div class="row connectedSortable">
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Processor') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Processor') ?></dt>
                        <dd><?= SystemInfo::getCpuinfo('model name') ?></dd>

                        <dt><?= Yii::t('backend', 'Processor Architecture') ?></dt>
                        <dd><?= SystemInfo::getArchitecture() ?></dd>

                        <dt><?= Yii::t('backend', 'Number of cores') ?></dt>
                        <dd><?= SystemInfo::getCpuCores() ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-6">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Operating System') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'OS') ?></dt>
                        <dd><?= SystemInfo::getOS() ?></dd>

                        <?php if(!SystemInfo::getIsWindows()): ?>
                            <dt><?= Yii::t('backend', 'OS Release') ?></dt>
                            <dd><?= SystemInfo::getLinuxOSRelease() ?></dd>

                            <dt><?= Yii::t('backend', 'Kernel version') ?></dt>
                            <dd><?= SystemInfo::getLinuxKernelVersion() ?></dd>
                        <?php endif; ?>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Network') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Hostname') ?></dt>
                        <dd><?= SystemInfo::getHostname() ?></dd>

                        <dt><?= Yii::t('backend', 'Internal IP') ?></dt>
                        <dd><?= SystemInfo::getServerIP() ?></dd>

                        <dt><?= Yii::t('backend', 'External IP') ?></dt>
                        <dd><?= SystemInfo::getExternalIP() ?></dd>

                        <dt><?= Yii::t('backend', 'Port') ?></dt>
                        <dd><?= $_SERVER['REMOTE_PORT'] ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Software') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Web Server') ?></dt>
                        <dd><?= SystemInfo::getServerSoftware() ?></dd>

                        <dt><?= Yii::t('backend', 'PHP Version') ?></dt>
                        <dd><?= SystemInfo::getPhpVersion() ?></dd>

                        <dt><?= Yii::t('backend', 'DB Type') ?></dt>
                        <dd><?= SystemInfo::getDbType(Yii::$app->db->pdo) ?></dd>

                        <dt><?= Yii::t('backend', 'DB Version') ?></dt>
                        <dd><?= SystemInfo::getDbVersion(Yii::$app->db->pdo) ?></dd>
                    </dl>
                </div><!-- /.box-body -->
            </div>
        </div>
        <div class="col-md-4">
            <div class="box box-primary">
                <div class="box-header">
                    <i class="fa fa-hdd-o"></i>
                    <h3 class="box-title"><?= Yii::t('backend', 'Memory') ?></h3>
                </div><!-- /.box-header -->
                <div class="box-body">
                    <dl class="dl-horizontal">
                        <dt><?= Yii::t('backend', 'Total memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalMem()) ?></dd>

                        <dt><?= Yii::t('backend', 'Free memory') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeMem()) ?></dd>

                        <dt><?= Yii::t('backend', 'Total Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getTotalSwap()) ?></dd>

                        <dt><?= Yii::t('backend', 'Free Swap') ?></dt>
                        <dd><?= Yii::$app->formatter->asSize(SystemInfo::getFreeSwap()) ?></dd>
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
                        <?= Yii::t('backend', '{uptime, duration}', ['uptime'=>SystemInfo::getUptime()]) ?>
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
                        <?= SystemInfo::getLoadAverage(5) ?>
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
                        <?= trntv\filekit\storage\models\FileStorageItem::find()->count() ?>
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