<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model admin\models\Post */
?>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
<?= $form->field($model, 'message')->textarea(['rows' => 4]);?>
 
          <?php ActiveForm::end(); ?>
</div>
