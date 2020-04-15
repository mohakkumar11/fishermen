<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
.navbar-brand {
  
    height: 100px  !important;
   
}
</style>
<div class="site-login">
<nav class="navbar navbar-default navbar-inverse navbar-static-top" role="navigation">

  <!-- Brand and toggle get grouped for better mobile display -->

  <div class="navbar-header">

    <!--<a class="navbar-brand" href="index.php"><img src="../images/logo-dark.png" height="80px" width="250px"></a>-->
 
  </div>



  

</nav>
    <div class="row">
        <div class="login-box">
            <div class="col-md-12 box box-radius">
            <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

                <?= $form->field($model, 'username', ['template' => '
                        <div class="col-sm-12" style="margin-top:15px;">
                            <div class="input-group col-sm-12">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-user"></span>
                                </span>
                                {input}
                            </div>{error}{hint}
                        </div>'])->textInput(['autofocus' => true])
                                ->input('text', ['placeholder'=>'Username']) ?>

                <?= $form->field($model, 'password', ['template' => '
                        <div class="col-sm-12" style="margin-top:15px;">
                            <div class="input-group col-sm-12">
                                <span class="input-group-addon">
                                    <span class="glyphicon glyphicon-lock"></span>
                                </span>
                                {input}
                            </div>{error}{hint}
                        </div>'])->passwordInput()
                                ->input('password', ['placeholder'=>'Password'])?>

                <?= $form->field($model, 'rememberMe')->checkbox() ?>

                <div class="form-group">
                    <?= Html::submitButton('Login', ['class' => 'btn btn-primary', 'name' => 'login-button']) ?>
                </div>

            <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>
