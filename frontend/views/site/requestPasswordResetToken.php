<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\PasswordResetRequestForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\bootstrap\Alert;

//$this->registerCssFile("@web/css/bootstrap.min.css");
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/css/responsive.css");
$this->registerCssFile("@web/css/animate.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerJsFile("@web/js/jquery.min.js");
$this->registerJsFile("@web/js/popper.js");
$this->registerJsFile("@web/js/bootstrap.min.js");
//$this->registerJsFile("@web/js/flatpickr.min.js");
$this->registerJsFile("@web/lib/slick/slick.min.js");
$this->registerJsFile("@web/js/script.js");

$this->title = 'Request password reset';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-request-password-reset container text-center">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>Please fill out your email. A link to reset password will be sent there.</p>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-12 col-lg-offset-3 col-md-offset-3">
            <?php $form = ActiveForm::begin(['id' => 'request-password-reset-form']); ?>

                <?= $form->field($model, 'email')->textInput(['autofocus' => true]) ?>

                <div class="form-group">
                    <?= Html::submitButton('Send', ['class' => 'btn btn-primary']) ?>
                </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>
</div>
<style>
footer {
	float: left;
	width: 100%;
	position: absolute;
    right: 0;
    bottom: 0;
    left: 0;
	background-color: #fff;
}
</style>