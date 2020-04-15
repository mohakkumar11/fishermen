<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
/* @var $this yii\web\View */
/* @var $model admin\models\Post */
?>
<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
 
   <?= $form->field($model, 'videoname')->fileInput(['accept' => 'video/mp4', 'class' => 'file_multi_video', 'onchange'=>'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])']) ?>
    
     <?php if($model->videoname!=''){?>
      <video style="border:1px solid" id="preview" width="200" height="150" controls >
      	<source src="<?= Yii::$app->request->baseUrl.'/videos/postVideo/'.$model->videoname ?>" type="video/mp4">
      </video>   		
		<?php } ?>
   <!-- <input type="file"  onchange="document.getElementById('preview').src = window.URL.createObjectURL(this.files[0])">-->

<video id ="preview" width="200" height="150" controls>
  <source src="video.mp4" type="video/mp4">
  <source src="video.ogg" type="video/ogg">
 <source src="video.webm" type="video/webm">
Your browser does not support the video tag.
</video>
    
    
          <?php ActiveForm::end(); ?>
</div>
