<?php

/* @var $this yii\web\View */

use yii\widgets\Breadcrumbs;

$this->title = 'Home - ReachOut';
?>
<!-- sidebar menu -->
<aside class="sidebar-300 offscreen-left bg-white">
    <div class="content-wrap">
        <div class="wrapper">
            <div class="slimScrollDiv" style="position: relative; overflow: hidden; width: auto; height: 312px;">
                <div class="slimscroll" id="userspanel"
                     data-online-url="<?php echo Yii::$app->urlManager->createUrl('users/who-is-online') ?>"
                     data-offline-url="<?php echo Yii::$app->urlManager->createUrl('users/who-is-offline') ?>"
                     data-height="auto" data-size="6px" data-distance="0"
                     style="overflow: auto; width: auto; height: 312px;">
                    <div class="pt15 pl15 pr15 pb0 clearfix">
                        <h3 class="mt0">
                            <div class="pull-right"> <a class="small mr5" href="javascript:;"> <i
                                        class="ti-time text-primary"></i> </a> <a class="small" href="javascript:;"> <i
                                        class="ti-settings"></i> </a></div>
                            <span class="small"> <i class="ti-arrow-circle-up text-success"></i> <small>YOU'RE ONLINE
                                </small> </span></h3>
                    </div>
                    <div class="p15 text-center">
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-outline btn-sm">All Users</button>
                            <button type="button" class="btn btn-default btn-outline btn-sm">Online</button>
                        </div>
                    </div>
                    <div class="pt15 pl15 pr15 pb0">
                        <div class="h6 text-muted"><b>ONLINE</b></div>
                    </div>
                    <div id="online-users"></div>
                    <div class="pt15 pl15 pr15 pb0">
                        <div class="h6 text-muted"><b>OFFLINE</b></div>
                    </div>
                    <div id="offline-users"></div>

                </div>
                <div class="slimScrollBar"
                     style="background: rgb(0, 0, 0); width: 6px; position: absolute; top: 0px; opacity: 0.4; display: none; border-radius: 7px; z-index: 99; right: 0px; height: 141.283px;"></div>
                <div class="slimScrollRail"
                     style="width: 6px; height: 100%; position: absolute; top: 0px; display: none; border-radius: 7px; background: rgb(51, 51, 51); opacity: 0.2; z-index: 90; right: 0px;"></div>
            </div>
        </div>
    </div>
    <script type="application/javascript">
        $(document).ready(function () {
            var host = window.location.host;


        });
    </script>
</aside>
<!-- /sidebar menu -->
<!-- main content -->

<section class="main-content index-main">
    <div class="content-wrap">
        <div class="wrapper">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel overflow-hidden no-b profile p15" style="background: transparent">
                        <div class="row mb25">
                            <div class="col-sm-12">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6">
                                        <h4 class="mb0"><?= Yii::$app->user->identity->title ?></h4>
                                        <br>
                                        <ul class="user-meta">
                                            <li><i class="ti-email mr5"></i> <span><?= Yii::$app->user->identity->email ?></span></li>
                                            <li><i class="ti-settings mr5"></i> <a href="javascript:;">Edit Profile</a>
                                            </li>
                                        </ul>
                                        <br>
                                        <h4 class="mb0">About <b><?= Yii::$app->user->identity->firstname ?> <?= Yii::$app->user->identity->lastname ?></b></h4>
                                        <br>

                                        <p>Gary, a mere mortal man of 25. Likes skipping rope and playing with small fluffy cute
                                            toys. Enjoys the occasional UI/UX Design.</p>

                                    </div>
                                    <div class="col-xs-12 col-sm-6 text-center">
                                        <figure style="margin-top: 30px"><img src="/projectFluxChat/web/img/faceless.jpg" alt=""
                                                     class="avatar avatar-lg img-circle avatar-bordered" style="width: 200px">
                                            <br>
                                            <br>
                                            <h3 class="mb0"><?= Yii::$app->user->identity->firstname ?> <b><?= Yii::$app->user->identity->lastname ?></b></h3>
                                            <p style="margin-top: 5px"><?= Yii::$app->user->identity->email ?></p>
                                        </figure>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-6 mt25 text-center bt">
                                <div class="col-xs-12 col-sm-6"><h2 class="mb0"><b>89</b></h2>
                                    <small>Messages</small>
                                </div>
                                <div class="col-xs-12 col-sm-6"><h2 class="mb0"><b>7</b></h2>
                                    <small>Threads</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-8">
                    <section class="panel panel-default">
                        <header class="panel-heading">
                            <div class="pull-right"><a class="mr5" href="javascript:;"> <i class="ti-info-alt"></i> </a>
                                <a href="javascript:;"> <i class="ti-settings"></i> </a></div>
                            <span class="small text-uppercase"> Quick Chat </span></header>
                        <div class="panel-body no-p">
                            <div class="chat-user" style="display: inline-block;"><a href="javascript:;" class="user-avatar"> <img
                                        src="/projectFluxChat/web/img/faceless.jpg" class="avatar avatar-sm img-circle"
                                        alt="">

                                    <div class="status bg-danger"></div>
                                </a>

                                <div class="user-details"><p>Brandon Cruz</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>
                            <div class="chat-user" style="display: inline-block;"><a href="javascript:;" class="user-avatar"> <img
                                        src="/projectFluxChat/web/img/faceless.jpg" class="avatar avatar-sm img-circle"
                                        alt="">

                                    <div class="status bg-danger"></div>
                                </a>

                                <div class="user-details"><p>Brandon Cruz</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>
                            <div class="chat-user" style="display: inline-block;"><a href="javascript:;" class="user-avatar"> <img
                                        src="/projectFluxChat/web/img/faceless.jpg" class="avatar avatar-sm img-circle"
                                        alt="">

                                    <div class="status bg-danger"></div>
                                </a>

                                <div class="user-details"><p>Brandon Cruz</p>
                                    <small class="user-department">Human Resources</small>
                                </div>
                            </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <a class="exit-offscreen"></a></section>


<section class="main-content chatbox-holder" style="display:none">
    <div class="content-wrap">
        <div class="wrapper" style="bottom: 50px; padding: 20px 30px 0px 30px">
            <div class="chat-box" data-thread="none" data-partner="none"
                 data-thread-url="<?= Yii::$app->urlManager->createUrl('messages/get-user-thread') ?>">

            </div>
        </div>
    </div>
    <footer class="bt">
        <div class="form-input clearfix mt10 mb10">
            <div class="input-group"><input id="new-message" class="form-control input-sm"
                                            placeholder="Say Something ..."> <span
                    class="input-group-btn"> <button id="submit-message" class="btn btn-default btn-sm" type="button"
                                                     data-url="<?= Yii::$app->urlManager->createUrl('messages/create') ?>">
                        <i
                            class="ti-arrow-right"></i></button> </span></div>
        </div>
    </footer>
    <a class="exit-offscreen"></a></section>
<!-- /main content -->

<!-- Right side bar -->
<aside class="sidebar-300 offscreen-right">
    <div class="content-wrap">
        <div class="wrapper">
            <section class="panel no-b">
                <div class="panel-body"><a href="javascript:;" class="show text-center"> <img
                            src="/projectFluxChat/web/img/faceless.jpg" class="avatar avatar-lg img-circle" alt=""> </a>

                    <div class="show mt15 mb15 text-center">
                        <div class="h5"><b>Gerald Morris</b></div>
                        <p class="show text-muted">San Francisco, CA</p></div>
                </div>
                <div class="panel-footer no-p no-b">
                    <div class="row no-m">
                        <div class="col-xs-6 bg-primary p10 text-center brbl"><a href="javascript:;"> <span
                                    class="ti-comments show mb5"></span> 782 </a></div>
                        <div class="col-xs-6 bg-info p10 text-center"></div>

                    </div>
                </div>
            </section>
        </div>
    </div>
</aside>
<!-- /Right side bar -->
