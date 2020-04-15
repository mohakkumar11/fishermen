<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model admin\models\Post */
?>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    <?= $form->field($model, 'message')->textarea(['rows' => 4]);?>
  <?= $form->field($model, 'imagename')->fileInput(['accept' => 'image/*', 'label' => false]) ?> 
  <span id="image-holder"> </span>
</div>
   
    <?php if($model->imagename!=''){?>
     		<div><img src="<?= Yii::$app->request->baseUrl.'/images/postImage/'.$model->imagename ?>" height="150" width="200"/></div>
		<?php } ?>
          <?php ActiveForm::end(); ?>
</div>
