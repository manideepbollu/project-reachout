<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model common\models\LoginForm */

$this->title = 'Login | ReachOut';

/* @var $this->params['login', 'signup'] - Manually introduced variables to toggle "Active class" between
 * login and Signup pages at layout.*/
$this->params = [
    'login' => 'active',
    'signup' => '',
];
?>
<!-- B - New Division -->

<?php $form = ActiveForm::begin([
    'id' => 'login-form',
    'layout' => 'default',
    'fieldConfig' => [
        'template' => '{input}<div class="help-block help-block-error main-login-help">{error}</div>',
    ],
]); ?>

<?= $form->field($model, 'email', [
    'inputOptions' => [
        'placeholder' => 'Enter Username',
        'class' => 'form-control input-lg mb25 mb25-scintin',
    ],
]) ?>

<?= $form->field($model, 'password', [
    'inputOptions' => [
        'placeholder' => 'Enter Password',
        'class' => 'form-control input-lg mb25 mb25-scintin',
    ],
])->passwordInput() ?>

<!--<div class="scintin-pull-right">-->
<!--    <a href="--><?//= Yii::$app->urlManager->createUrl('site/request-password-reset') ?><!--">Forgot password?</a>-->
<!--</div>-->

<div class="form-group">
    <?= Html::checkbox('LoginForm[rememberMe]',true); ?>
    <?= 'Remember me' ?>
</div>

<?= Html::submitButton('Login', [
    'class' => 'btn btn-primary btn-lg btn-block',
    'name' => 'login-button',
    'type' => 'submit',
]) ?>

<?php ActiveForm::end(); ?>
