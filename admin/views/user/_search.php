<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model admin\models\UserSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="user-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'username') ?>

    

    <?= $form->field($model, 'last_name') ?>

    <?= $form->field($model, 'gender') ?>

    <?php // echo $form->field($model, 'auth_key') ?>

    <?php // echo $form->field($model, 'password_hash') ?>

    <?php // echo $form->field($model, 'confirm_password') ?>

    <?php // echo $form->field($model, 'password_reset_token') ?>

    <?php // echo $form->field($model, 'email') ?>

    <?php // echo $form->field($model, 'phone') ?>

    <?php // echo $form->field($model, 'status') ?>

    <?php // echo $form->field($model, 'dob') ?>

    <?php // echo $form->field($model, 'createdate') ?>

    <?php // echo $form->field($model, 'updatedate') ?>

    <?php // echo $form->field($model, 'address1') ?>

    <?php // echo $form->field($model, 'usertype') ?>

    <?php // echo $form->field($model, 'partyId') ?>

    <?php // echo $form->field($model, 'countryId') ?>

    <?php // echo $form->field($model, 'stateId') ?>

    <?php // echo $form->field($model, 'address2') ?>

    <?php // echo $form->field($model, 'country') ?>

    <?php // echo $form->field($model, 'state') ?>

    <?php // echo $form->field($model, 'city') ?>

    <?php // echo $form->field($model, 'zip') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
