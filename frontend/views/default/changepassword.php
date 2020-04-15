<?php 
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
//$this->params['breadcrumbs'][] = $this->title;
$this->params['pass'] = 'active opened active';
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
?>
<br />
<br />
<div class="container">

<style>

</style>
<div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->

    <!-- Icon -->
    <div class="fadeIn first">
   <h3 class="violet_fnt">Change password</h3>
    </div>

    <!-- Login Form -->
    
     <?php $form = ActiveForm::begin([
                                'id'=>'changepassword-form',
                                'options'=>['class'=>'form-horizontal']
                               
                            ]); ?>
                                <?= $form->field($model,'oldpass',['inputOptions'=>[
                                    'placeholder'=>'Old Password', 'class' => 'fadeIn inp_second  form-control'
                                ]])->passwordInput()->label(false); ?>
                                
                                <?= $form->field($model,'newpass',['inputOptions'=>[
                                    'placeholder'=>'New Password', 'class' => 'fadeIn inp_second  form-control'
                                ]])->passwordInput()->label(false); ?>
                                
                                <?= $form->field($model,'repeatnewpass',['inputOptions'=>[
                                    'placeholder'=>'Repeat New Password', 'class' => 'fadeIn inp_second  form-control'
                                ]])->passwordInput()->label(false); ?>
                                
                                <div class="form-group">
                                    <div class="">
                                        <?= Html::submitButton('Change password',[
                                            'class'=>'btn zbtn-primary sbn_btn center-block'
                                        ]) ?>
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>

  </div>
</div>


</div>
