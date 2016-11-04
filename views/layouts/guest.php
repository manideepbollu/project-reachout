<?php
use yii\helpers\Html;
use app\assets\CoreAsset;

/* @var $this \yii\web\View */
/* @var $content string */
/* @var $this->params['login'] string, @var $this->params['signup'] string
 * These variables are introduced manually to toggle "Active class" between login and signup
 * as per the page position. These values must be set in the views of login and signup actions */

CoreAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">

<!-- head -->
<head>
    <meta charset="<?= Yii::$app->charset ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<!-- /head -->

<!-- body -->

<body class="bg-primary">
<?php $this->beginBody() ?>

    <div class="cover"></div>

    <div class="overlay bg-primary">
        <!-- Begin flash messages if any -->
        <?php
        foreach (Yii::$app->session->getAllFlashes() as $key => $message) {
            echo '<div class="alert alert-'. $key .' text-center">' . $message . '</div>';
        }
        ?>
        <!-- End flash messages -->
    </div>

    <div class="center-wrapper">
        <div class="center-content">
            <div class="row">
                <div class="col-xs-10 col-xs-offset-1 col-sm-6 col-sm-offset-3 col-md-4 col-md-offset-4">
                    <section class="panel bg-white no-b">
                        <ul class="switcher-dash-action">
                            <li class="<?= $this->params['login'] ?>"><a href="<?= Yii::$app->urlManager->createUrl('site/login') ?>" class="selected">Sign in</a></li>
                            <li class="<?= $this->params['signup'] ?>"><a href="<?= Yii::$app->urlManager->createUrl('users/create') ?>" class="">New account</a></li>
                        </ul>

                        <!-- View content is being passed inside the below div -->
                        <div class="p15">
                            <?= $content ?>
                        </div>


                    </section>
                    <p class="text-center">
                        Copyright &copy;
                        <span id="year" class="mr5"></span>
                        <a href="<?= Yii::$app->urlManager->createUrl('site/about') ?>">About Project FluxChat</a>
                    </p>
                </div>
            </div>

        </div>
    </div>
    <script type="text/javascript">
    var el = document.getElementById("year"),
        year = (new Date().getFullYear());
    el.innerHTML = year;
</script>
<?php $this->endBody() ?>
</body>
<!-- /body -->

</html>
<?php $this->endPage() ?>
