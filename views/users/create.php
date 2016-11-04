<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/* @var $this yii\web\View */
/* @var $model app\models\user\User */

$this->title = 'New User | ReachOut';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$this->params = [
    'login' => '',
    'signup' => 'active',
];
?>
<!-- B - New Division -->

<?php $form = ActiveForm::begin([
    'id' => 'user',
    'layout' => 'default',
    'fieldConfig' => [
        'template' => '{input}<div class="help-block help-block-error main-login-help">{error}</div>',
    ],
]); ?>

<?= $form->field($model, 'firstname', [
    'inputOptions' => [
        'placeholder' => 'Enter Firstname',
        'class' => 'form-control input-lg mb25 mb25-scintin',
    ],
]) ?>

<?= $form->field($model, 'lastname', [
    'inputOptions' => [
        'placeholder' => 'Enter Lastname',
        'class' => 'form-control input-lg mb25 mb25-scintin',
    ],
]) ?>

<?= $form->field($model, 'title', [
    'inputOptions' => [
        'placeholder' => 'Enter Title',
        'class' => 'form-control input-lg mb25 mb25-scintin',
    ],
]) ?>

<?= $form->field($model, 'email', [
    'inputOptions' => [
        'placeholder' => 'Enter Email',
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

<?= Html::submitButton('Create', [
    'class' => 'btn btn-primary btn-lg btn-block',
    'name' => 'login-button',
    'type' => 'submit',
]) ?>

<?php ActiveForm::end(); ?>

