<?php
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use admin\models\User;
use dosamigos\datepicker\DatePicker;
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
$this->registerJsFile("@web/lib/slick/slick.min.js");
$this->registerJsFile("@web/js/script.js");
$DOB = date("m-d-Y",strtotime($model -> dob));
?>
  <div class="bg_container" ><!--start bg_container-->
  <div class="container">
      <div class="row centered-form">
        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12   zcol-sm-offset-6 zcol-md-offset-6"> 
          <!--start panel-->
          <div class="my_profile">
            <div class="panel-body white_bg">
             <!-- <form role="form">-->
              <?php $form = ActiveForm::begin();?>
              	<div class="form-group ">
                  <label for="Address">Personal Details</label>
                </div>
                <div class="row">
                  <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                    </div>
                  </div>
                </div>
                <div class="form-group">
                	<div class="row"><div class="col-xs-6 col-sm-6 col-md-6"><?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?></div>
                    </div>
                </div>
                <div class="row">
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                      <?= $form->field($model, 'phone')->textInput() ?>
                    </div>
                </div>
                <div class="col-xs-6 col-sm-6 col-md-6">
                    <div class="form-group">
                       <?= $form->field($model, 'gender')->radioList(['M' => 'Male', 'F' => 'Female', ]) ?>
                  </div>
                </div>
                </div>    
                <div class="form-group ">
                  <label for="Address">Address</label>
                  <?= $form->field($model, 'address1')->textInput(['maxlength' => true])-> label(false); ?>
                </div>
                 <div class="row">
                <div class="form-group col-sm-6">
                  <div class="row">
                    <div class="col-sm-12"> <?= $form->field($model, 'city')->textInput(['maxlength' => true]) ?></div>
                </div>
                </div>
                <div class="form-group col-sm-6">
                  <div class="row">
                     <div class="col-sm-12"> <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?></div>
                  </div>
                </div>
                </div>
                <div class="clearfix"></div>
			    <div class="form-group">
					<?php if(!$model->id){?>
                            <?= $form->field($model, 'password_hash')->passwordInput() ?>
                        <?php } ?>                  <span id="error_gender" class="text-danger"></span> </div>
                 <div class="form-group">
    					<?= $form->field($model, 'dob')->textInput(['value' => $DOB])->label('Date-Of-Birth(mm-dd-yyyy)')->widget(
						DatePicker::className(),[
						'clientOptions' => [
						'autoclose' => true,
						'format' => 'dd-mm-yyyy',
						'todayBtn' => true
					   ]
						]); ?>                   
									  <span id="error_gender" class="text-danger"></span> </div>
                  <div class="form-group">
                     <?= $form->field($model, 'user_pic')->fileInput(['multiple' => true, 'accept' => 'image/*']) ->label('Profile Picture');?>
					<?php
					 if($model->user_pic !=''){?>
                        <img src="<?= Yii::$app->request->baseUrl.'/admin/images/user/'.$model->user_pic ?>" height="200" width="200"/>
                    <?php } ?>
                </div>
        			<?= Html::submitButton('Update Your Profile' , ['class' => 'btn btn-sm cu_btn-primary center-block']) ?>
                 <?php ActiveForm::end(); ?>
              <!--</form>-->
            </div>
          </div>
          <!--end panel--> 
        </div>
      </div>
  </div>
</div>