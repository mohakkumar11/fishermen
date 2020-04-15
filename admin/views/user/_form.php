<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\ArrayHelper;
use admin\models\Country;
use admin\models\User;
use admin\models\PoliticalParty;

/* @var $this yii\web\View */
/* @var $model admin\models\User */
/* @var $form yii\widgets\ActiveForm */
$stateList = User :: Statelists();
?>

<div class="user-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'username')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>

    

    <?= $form->field($model, 'gender')->dropDownList([ 'M' => 'Male', 'F' => 'Female', ], ['prompt' => '']) ?>
    
    <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
    <?php if(!$model->id){?>
    <?= $form->field($model, 'password_hash')->passwordInput(['maxlength' => true]) ?>
    <?php } ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'address1')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'usertype')->dropDownList([ 'L' => 'Leader', 'F' => 'Follower', 'B' => 'Both'], ['prompt' => '']) ?>
     <?= $form->field($model, 'user_pic')->fileInput(['multiple' => true, 'accept' => 'image/*']) ->label('Profile Picture');?>
        <?php if($model->user_pic!=''){?>
     		<img src="<?= Yii::$app->request->baseUrl.'/images/user/'.$model->user_pic ?>" height="150" width="200"/>
		<?php } ?>
   

    <?php
	//$countries= Country::find()->all();
	
	//$listData=ArrayHelper::map($countries,'id','name');
	?>
    <?php //= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => 'Select Country']) ?>

   <?php /*?> <?= $form->field($model, 'stateId')->dropDownList(
          [User::Statelists()],
          //[ArrayHelper::map(User::findAll(['active' => '1']), 'id', 'name')],
          ['prompt'=>'Select a user'],    
          ['options' => $stateList]

        )
		?><?php */?>

    <?= $form->field($model, 'zip')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
