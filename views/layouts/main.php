<?php
use yii\helpers\Html;
use app\assets\CoreAsset;

/* @var $this \yii\web\View */
/* @var $content string */

CoreAsset::register($this);

?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<!-- body -->

<body>
<?php $this->beginBody() ?>
<div class="app">
    <!-- top header -->
    <header class="header header-fixed navbar">

        <div class="brand" style="width: 300px; padding-left: 20px">
            <!-- toggle offscreen menu -->
            <a href="javascript:;" class="ti-menu off-left visible-xs" data-toggle="offscreen" data-move="ltr"></a>
            <!-- /toggle offscreen menu -->

            <!-- logo -->
            <a href="<?= Yii::getAlias('@web') ?>" class="navbar-brand">
                <img src="<?= Yii::getAlias('@web') ?>/img/logo.png" alt="">
                    <span class="heading-font">
                        ReachOut
                    </span>
            </a>
            <!-- /logo -->
        </div>

        <ul class="nav navbar-nav">
            <li class="header-search">
                <!-- toggle search -->
                <a href="javascript:;" class="toggle-search">
                    <i class="ti-search"></i>
                </a>
                <!-- /toggle search -->
                <div class="search-container">
                    <form role="search">
                        <input type="text" class="form-control search" placeholder="type and press enter">
                    </form>
                </div>
            </li>
        </ul>

        <ul class="nav navbar-nav navbar-right">

            <li class="hidden-xs">
                <a href="<?= Yii::$app->urlManager->createUrl('site/index') ?>">
                    <i class="ti-home"></i>
                </a>
            </li>
            <li>
                <a href="javascript:;" data-toggle="dropdown">
                    <i class="ti-info-alt"> </i>
                </a>
            </li>

            <li class="notifications dropdown">
                <a href="javascript:;" data-toggle="dropdown">
                    <i class="ti-bell"></i>
                    <div class="badge badge-top bg-danger animated flash">
                        <span>3</span>
                    </div>
                </a>
                <div class="dropdown-menu animated fadeInLeft">
                    <div class="panel panel-default no-m">
                        <div class="panel-heading small"><b>Notifications</b>
                        </div>
                        <ul class="list-group">
                            <li class="list-group-item">
                                <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="<?= Yii::getAlias('@web') ?>/img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                    <div class="m-body">
                                        <div class="">
                                            <small><b>CRYSTAL BROWN</b></small>
                                            <span class="label label-primary pull-right">New Message</span>
                                        </div>
                                        <span>Hey, how are you...</span>
                                        <span class="time small">2 mins ago</span>
                                    </div>
                                </a>
                            </li>
                            <li class="list-group-item">
                                <a href="javascript:;">
                                        <span class="pull-left mt5 mr15">
                                            <img src="<?= Yii::getAlias('@web') ?>/img/faceless.jpg" class="avatar avatar-sm img-circle" alt="">
                                        </span>
                                    <div class="m-body">
                                        <div class="">
                                            <small><b>Tim Cook</b></small>
                                            <span class="label label-primary pull-right">New Message</span>
                                        </div>
                                        <span>Good morning!</span>
                                        <span class="time small">8 mins ago</span>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </li>
            <li class="off-right">
                <a href="javascript:;" data-toggle="dropdown">
                    <img src="<?= Yii::getAlias('@web') ?>/img/faceless.jpg" class="header-avatar img-circle" data-selfuser-name="<?= Yii::$app->user->identity->firstname ?> <?= Yii::$app->user->identity->lastname ?>" data-selfuser="<?= Yii::$app->user->identity->id ?>" data-alive-url="<?= Yii::$app->urlManager->createUrl('users/still-alive') ?>" alt="user" title="user">
                    <span class="hidden-xs ml10"><?= Yii::$app->user->identity->firstname ?></span>
                    <i class="ti-angle-down ti-caret hidden-xs"></i>
                </a>
                <ul class="dropdown-menu animated fadeInLeft">
                    <li>
                        <a href="javascript:;">Edit personal info</a>
                    </li>
                    <li>
                        <a href="javascript:;">
                            <div class="badge bg-danger pull-right">3</div>
                            <span>Notifications</span>
                        </a>
                    </li>
                    <li>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/logout') ?>">Logout</a>
                    </li>
                </ul>
            </li>
        </ul>
    </header>
    <!-- /top header -->

    <section class="layout">
        <?= $content ?>


    </section>

</div>

<?php $this->endBody() ?>
</body>
<!-- /body -->

</html>
<?php $this->endPage() ?>
