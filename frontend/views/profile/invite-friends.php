<?php 
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Invite Friends';
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
/*$this->registerJs(
    "$('#submitBtn').click(function() {
       var emailField = $('#invitefriends-to_address').val();  
 	   var reg = /^(([^<>()\[\]\.,;:\s@\"]+(\.[^<>()\[\]\.,;:\s@\"]+)*)|(\".+\"))@(([^<>()[\]\.,;:\s@\"]+\.)+[^<>()[\]\.,;:\s@\"]{2,})$/i;
     if (reg.test(emailField) == false) 
	 {
	 	alert('Invalid Email Address');
	 	return false;
	 }
    return true;
            })  ;"
    );
	*/
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
   <h3 class="violet_fnt">Invite Friends</h3>
    </div>

    <!-- Login Form -->
    
     <?php $form = ActiveForm::begin([
                                'id'=>'changepassword-form',
                                'options'=>['class'=>'form-horizontal']
                               
                            ]); ?>
                           
                                <?= $form->field($model,'to_address',['inputOptions'=>[
                                    'placeholder'=>'Type email Address here', 'class' => 'fadeIn inp_second  form-control'
                                ]])->textInput(['required' => true])->label(false); ?>
                                <p> (If You want to send Multiple Emails for Friend Invitations, Then use Coma(,)  as a separator) </p>
                                
                                <?= $form->field($model,'message',['inputOptions'=>[
                                    'placeholder'=>'Type your Message here', 'class' => 'fadeIn inp_second  form-control'
                                ]])->textArea(['rows' => '6','columns' => '6', 'value' => 'I just joined jijigram here is the link www.jijigram.com. You can also download the App.', 'required' => true])->label(false); ?>
                                
                                <div class="form-group">
                                    <div class="">
                                        <?= Html::submitButton('Send Invitation',[
                                            'class'=>'btn zbtn-primary sbn_btn center-block',
											'id'=>'submitBtn','onClick'=>'checkEmail'
                                        ]) ?>
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>

  </div>
</div>


</div>
