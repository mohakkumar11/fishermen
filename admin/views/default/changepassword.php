<?php 
use yii\helpers\Html;
use yii\bootstrap\Alert;
use yii\bootstrap\ActiveForm;

$this->title = 'Change Password';
$this->params['breadcrumbs'][] = $this->title;
$this->params['pass'] = 'active opened active';
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<div class="col-lg-12 padded">

  <div class="row">

    <!-- Breadcrumb line -->

    <div id="breadcrumbs">

      <div class="breadcrumb-button blue"> <span class="breadcrumb-label"><i class="icon-home"></i> Password</span> <span class="breadcrumb-arrow"><span></span></span> </div>

      <div class="breadcrumb-button"> <span class="breadcrumb-label"> <i class="icon-dashboard"></i> Change password </span> <span class="breadcrumb-arrow"><span></span></span> </div>

      <!--<div style="float:right; margin-top:10px;"><a href="widgetsettings.php">Manage Widget Setting</a></div>-->

    </div>

  </div>

</div>
            <div class="row">
                <div class="col-md-12">

                            <h2 class="panel-title"><strong><?= Html::encode($this->title) ?></strong></h2>

                            <?php $form = ActiveForm::begin([
                                'id'=>'changepassword-form',
                                'options'=>['class'=>'form-horizontal'],
                                'fieldConfig'=>[
                                    'template'=>"{label}\n<div class=\"col-lg-3\">
                                                {input}</div>\n<div class=\"col-lg-5\">
                                                {error}</div>",
                                    'labelOptions'=>['class'=>'col-lg-2 control-label'],
                                ],
                            ]); ?>
                                <?= $form->field($model,'oldpass',['inputOptions'=>[
                                    'placeholder'=>'Old Password'
                                ]])->passwordInput() ?>
                                
                                <?= $form->field($model,'newpass',['inputOptions'=>[
                                    'placeholder'=>'New Password'
                                ]])->passwordInput() ?>
                                
                                <?= $form->field($model,'repeatnewpass',['inputOptions'=>[
                                    'placeholder'=>'Repeat New Password'
                                ]])->passwordInput() ?>
                                
                                <div class="form-group">
                                    <div class="col-lg-offset-2 col-lg-4">
                                        <?= Html::submitButton('Change password',[
                                            'class'=>'btn btn-primary'
                                        ]) ?>
                                    </div>
                                </div>
                            <?php ActiveForm::end(); ?>
                </div>
            </div>
