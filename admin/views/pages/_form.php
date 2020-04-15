<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;

/* @var $this yii\web\View */
/* @var $model admin\models\Pages */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="pages-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->widget(CKEditor::className()); ?>

    <?= $form->field($model, 'featuredimage')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metatitle')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metakeywords')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metadescription')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <div class="form-group">
        <?= Html::submitButton('Save', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
