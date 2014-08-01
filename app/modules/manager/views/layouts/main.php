<?php
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;

/* @var $this \yii\web\View */
/* @var $content string */

\app\modules\manager\assets\ManagerAsset::register($this);
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>

    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>

<!--    <link href="css/morris/morris.css" rel="stylesheet" type="text/css" />
    <link href="css/jvectormap/jquery-jvectormap-1.2.2.css" rel="stylesheet" type="text/css" />
    <link href="css/fullcalendar/fullcalendar.css" rel="stylesheet" type="text/css" />
    <link href="css/daterangepicker/daterangepicker-bs3.css" rel="stylesheet" type="text/css" />-->


</head>
<?php $this->beginBody() ?>
<body class="skin-blue">
<!-- header logo: style can be found in header.less -->
<header class="header">
<a href="<?= Yii::$app->homeUrl ?>" class="logo">
    <!-- Add the class icon to your logo image or logo icon to add the margining -->
    Yii2 Starter Kit
</a>
<!-- Header Navbar: style can be found in header.less -->
<nav class="navbar navbar-static-top" role="navigation">
<!-- Sidebar toggle button-->
<a href="#" class="navbar-btn sidebar-toggle" data-toggle="offcanvas" role="button">
    <span class="sr-only"><?= Yii::t('backend', 'Toggle navigation') ?></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
    <span class="icon-bar"></span>
</a>
<div class="navbar-right">
<ul class="nav navbar-nav">
<!-- Messages: style can be found in dropdown.less-->
<li class="dropdown messages-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-envelope"></i>
        <span class="label label-success">4</span>
    </a>
    <ul class="dropdown-menu">
        <li class="header">You have 4 messages</li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <li><!-- start message -->
                    <a href="#">
                        <div class="pull-left">
                            <img src="img/avatar3.png" class="img-circle" alt="User Image"/>
                        </div>
                        <h4>
                            Support Team
                            <small><i class="fa fa-clock-o"></i> 5 mins</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li><!-- end message -->
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                        </div>
                        <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="img/avatar.png" class="img-circle" alt="user image"/>
                        </div>
                        <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="img/avatar2.png" class="img-circle" alt="user image"/>
                        </div>
                        <h4>
                            Sales Department
                            <small><i class="fa fa-clock-o"></i> Yesterday</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <div class="pull-left">
                            <img src="img/avatar.png" class="img-circle" alt="user image"/>
                        </div>
                        <h4>
                            Reviewers
                            <small><i class="fa fa-clock-o"></i> 2 days</small>
                        </h4>
                        <p>Why not buy a new awesome theme?</p>
                    </a>
                </li>
            </ul>
        </li>
        <li class="footer"><a href="#">See All Messages</a></li>
    </ul>
</li>
<!-- Notifications: style can be found in dropdown.less -->
<li class="dropdown notifications-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-warning"></i>
        <span class="label label-danger">
            <?= \app\modules\manager\models\SystemLog::find()->count() ?>
        </span>
    </a>
    <ul class="dropdown-menu">
        <li class="header"><?= Yii::t('backend', 'You have {num} log items', ['num'=>\app\modules\manager\models\SystemLog::find()->count()]) ?></li>
        <li>
            <!-- inner menu: contains the actual data -->
            <ul class="menu">
                <?php foreach(\app\modules\manager\models\SystemLog::find()->orderBy(['log_time'=>SORT_DESC])->limit(5)->all() as $logEntry): ?>
                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl(['/manager/log/view', 'id'=>$logEntry->id]) ?>">
                            <i class="fa fa-warning <?= \yii\log\Logger::getLevelName($logEntry->level) ?>"></i>
                            <?= $logEntry->category ?>
                        </a>
                    </li>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="footer">
            <?= Html::a(Yii::t('backend', 'View all'), ['/manager/log']) ?>
        </li>
    </ul>
</li>

<!-- User Account: style can be found in dropdown.less -->
<li class="dropdown user user-menu">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="glyphicon glyphicon-user"></i>
        <span><?= Yii::$app->user->identity->username ?> <i class="caret"></i></span>
    </a>
    <ul class="dropdown-menu">
        <!-- User image -->
        <li class="user-header bg-light-blue">
            <?php if(Yii::$app->user->identity->picture): ?>
            <img src="<?php Yii::$app->user->identity->picture ?>" class="img-circle" alt="User Image" />
            <?php endif; ?>
            <p>
                <?php Yii::$app->user->identity->username ?>
                <small>
                    <?= Yii::t('backend', 'Member since {0, date, short}', strtotime(Yii::$app->user->identity->created_at)) ?>
                </small>
        </li>
        <!-- Menu Body -->
        <li class="user-body">
            <div class="col-xs-4 text-center">
                <a href="#">Followers</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Sales</a>
            </div>
            <div class="col-xs-4 text-center">
                <a href="#">Friends</a>
            </div>
        </li>
        <!-- Menu Footer-->
        <li class="user-footer">
            <div class="pull-left">
                <a href="#" class="btn btn-default btn-flat">Profile</a>
            </div>
            <div class="pull-right">
                <?= Html::a(Yii::t('common', 'Logout'), ['/user/logout'], ['class'=>'btn btn-default btn-flat']) ?>
            </div>
        </li>
    </ul>
</li>
</ul>
</div>
</nav>
</header>
<div class="wrapper row-offcanvas row-offcanvas-left">
<!-- Left side column. contains the logo and sidebar -->
<aside class="left-side sidebar-offcanvas">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <?php if(Yii::$app->user->identity->picture): ?>
                <div class="pull-left image">
                    <img src="<?= Yii::$app->user->identity->picture ?>" class="img-circle" alt="User Image" />
                </div>
            <?php endif; ?>
            <div class="pull-left info">
                <p><?= Yii::t('backend', 'Hello, {username}', ['username'=>Yii::$app->user->identity->username]) ?></p>
                <a href="#">
                    <i class="fa fa-circle text-success"></i>
                    <?= Yii::$app->formatter->asTime(time()) ?>
                </a>
            </div>
        </div>
        <!-- search form -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search..."/>
                            <span class="input-group-btn">
                                <button type='submit' name='seach' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
                            </span>
            </div>
        </form>
        <!-- /.search form -->
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <?= \app\components\widgets\menu\Widget::widget([
            'options'=>['class'=>'sidebar-menu'],
            'labelTemplate' => '<a href="#">{icon}<span>{label}</span>{right-icon}{badge}</a>',
            'linkTemplate' => '<a href="{url}">{icon}<span>{label}</span>{right-icon}{badge}</a>',
            'submenuTemplate'=>"\n<ul class=\"treeview-menu\">\n{items}\n</ul>\n",
            'activateParents'=>true,
            'items'=>[
                [
                    'label'=>Yii::t('backend', 'Dashboard'),
                    'icon'=>'<i class="fa fa-bar-chart-o"></i>',
                    'url'=>['/manager/default/index']
                ],
                [
                    'label'=>Yii::t('backend', 'Content'),
                    'icon'=>'<i class="fa fa-edit"></i>',
                    'options'=>['class'=>'treeview'],
                    'items'=>[
                        ['label'=>Yii::t('backend', 'Static pages'), 'url'=>['/manager/page/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        ['label'=>Yii::t('backend', 'Articles'), 'url'=>['/manager/article/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        ['label'=>Yii::t('backend', 'Article Categories'), 'url'=>['/manager/article-category/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        ['label'=>Yii::t('backend', 'Text Widgets'), 'url'=>['/manager/widget-text/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        ['label'=>Yii::t('backend', 'Menu Widgets'), 'url'=>['/manager/widget-menu/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        ['label'=>Yii::t('backend', 'Carousel Widgets'), 'url'=>['/manager/widget-carousel/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                    ]
                ],
                [
                    'label'=>Yii::t('backend', 'Users'),
                    'icon'=>'<i class="fa fa-users"></i>',
                    'url'=>['/manager/user/index']
                ],
                [
                    'label'=>Yii::t('backend', 'System'),
                    'icon'=>'<i class="fa fa-cogs"></i>',
                    'options'=>['class'=>'treeview'],
                    'items'=>[
                        ['label'=>Yii::t('backend', 'File Manager'), 'url'=>['/manager/file-manager/index'], 'icon'=>'<i class="fa fa-angle-double-right"></i>'],
                        [
                            'label'=>Yii::t('backend', 'Logs'),
                            'url'=>['/manager/log/index'],
                            'icon'=>'<i class="fa fa-angle-double-right"></i>',
                            'badge'=>\app\modules\manager\models\SystemLog::find()->count(),
                            'badgeBgClass'=>'bg-red',
                        ],
                    ]
                ]
            ]
        ]) ?>
        <!--<ul class="sidebar-menu">
            <li class="active">
                <a href="index.html">
                    <i class="fa fa-dashboard"></i> <span>Dashboard</span>
                </a>
            </li>
            <li>
                <a href="pages/widgets.html">
                    <i class="fa fa-th"></i> <span>Widgets</span>
                    <small class="badge pull-right bg-green">new</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-bar-chart-o"></i>
                    <span>Charts</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/charts/morris.html"><i class="fa fa-angle-double-right"></i> Morris</a></li>
                    <li><a href="pages/charts/flot.html"><i class="fa fa-angle-double-right"></i> Flot</a></li>
                    <li><a href="pages/charts/inline.html"><i class="fa fa-angle-double-right"></i> Inline charts</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-laptop"></i>
                    <span>UI Elements</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/UI/general.html"><i class="fa fa-angle-double-right"></i> General</a></li>
                    <li><a href="pages/UI/icons.html"><i class="fa fa-angle-double-right"></i> Icons</a></li>
                    <li><a href="pages/UI/buttons.html"><i class="fa fa-angle-double-right"></i> Buttons</a></li>
                    <li><a href="pages/UI/sliders.html"><i class="fa fa-angle-double-right"></i> Sliders</a></li>
                    <li><a href="pages/UI/timeline.html"><i class="fa fa-angle-double-right"></i> Timeline</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-edit"></i> <span>Forms</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/forms/general.html"><i class="fa fa-angle-double-right"></i> General Elements</a></li>
                    <li><a href="pages/forms/advanced.html"><i class="fa fa-angle-double-right"></i> Advanced Elements</a></li>
                    <li><a href="pages/forms/editors.html"><i class="fa fa-angle-double-right"></i> Editors</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-table"></i> <span>Tables</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/tables/simple.html"><i class="fa fa-angle-double-right"></i> Simple tables</a></li>
                    <li><a href="pages/tables/data.html"><i class="fa fa-angle-double-right"></i> Data tables</a></li>
                </ul>
            </li>
            <li>
                <a href="pages/calendar.html">
                    <i class="fa fa-calendar"></i> <span>Calendar</span>
                    <small class="badge pull-right bg-red">3</small>
                </a>
            </li>
            <li>
                <a href="pages/mailbox.html">
                    <i class="fa fa-envelope"></i> <span>Mailbox</span>
                    <small class="badge pull-right bg-yellow">12</small>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-folder"></i> <span>Examples</span>
                    <i class="fa fa-angle-left pull-right"></i>
                </a>
                <ul class="treeview-menu">
                    <li><a href="pages/examples/invoice.html"><i class="fa fa-angle-double-right"></i> Invoice</a></li>
                    <li><a href="pages/examples/login.html"><i class="fa fa-angle-double-right"></i> Login</a></li>
                    <li><a href="pages/examples/register.html"><i class="fa fa-angle-double-right"></i> Register</a></li>
                    <li><a href="pages/examples/lockscreen.html"><i class="fa fa-angle-double-right"></i> Lockscreen</a></li>
                    <li><a href="pages/examples/404.html"><i class="fa fa-angle-double-right"></i> 404 Error</a></li>
                    <li><a href="pages/examples/500.html"><i class="fa fa-angle-double-right"></i> 500 Error</a></li>
                    <li><a href="pages/examples/blank.html"><i class="fa fa-angle-double-right"></i> Blank Page</a></li>
                </ul>
            </li>
        </ul>-->
    </section>
    <!-- /.sidebar -->
</aside>

<!-- Right side column. Contains the navbar and content of the page -->
<aside class="right-side">
<!-- Content Header (Page header) -->
<section class="content-header">
    <h1>
        <?= $this->title ?>
        <?php if(isset($this->params['subtitle'])): ?>
            <small><?= $this->params['subtitle'] ?></small>
        <?php endif; ?>
    </h1>

    <?= Breadcrumbs::widget([
        'tag'=>'ol',
        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
    ]) ?>

</section>

<!-- Main content -->
<section class="content">
    <?= $content ?>
</section><!-- /.content -->
</aside><!-- /.right-side -->
</div><!-- ./wrapper -->

<!-- add new calendar event modal -->

<!--<script src="//cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="js/plugins/morris/morris.min.js" type="text/javascript"></script>
<script src="js/plugins/sparkline/jquery.sparkline.min.js" type="text/javascript"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-1.2.2.min.js" type="text/javascript"></script>
<script src="js/plugins/jvectormap/jquery-jvectormap-world-mill-en.js" type="text/javascript"></script>
<script src="js/plugins/fullcalendar/fullcalendar.min.js" type="text/javascript"></script>
<script src="js/plugins/jqueryKnob/jquery.knob.js" type="text/javascript"></script>
-->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>