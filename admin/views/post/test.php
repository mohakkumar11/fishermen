<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use admin\models\User;
use	yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model admin\models\Post */
/* @var $form yii\widgets\ActiveForm */

$this->registerJs(

    '$("document").ready(function(){
		 $("#preview").hide();
		 $("#post-imagename").on("change", function() {	
          //Get count of selected files
          var countFiles = $(this)[0].files.length; 
          var imgPath = $(this)[0].value; 
          var extn = imgPath.substring(imgPath.lastIndexOf(".") + 1).toLowerCase();
          var image_holder = $("#image-holder");
          image_holder.empty();
          if (extn == "gif" || extn == "png" || extn == "jpg" || extn == "jpeg") {
            if (typeof(FileReader) != "undefined") {
              //loop for each file selected for uploaded.
              for (var i = 0; i < countFiles; i++) 
              {
                var reader = new FileReader();
                reader.onload = function(e) {
                  $("<img />", {
                    "src": e.target.result,
                    "class": "thumb-image",
					 "height": 200,
					  "width": 200,
                  }).appendTo(image_holder);
                }
                image_holder.show();
                reader.readAsDataURL($(this)[0].files[i]);
              }
            } else {
              echo (image_holder);
            }
          } else {
            //alert ("Pls select only images");
          }
        
			  });
			   $("#post-videoname").on("change", function() {
				      $("#preview").show();
			  var loadFile = function(event) {
    var output = document.getElementById("preview");
    output.src = URL.createObjectURL(event.target.files[0]);
  };
	 });		 
		});'
	
    );

?>

<div class="post-form">

    <?php $form = ActiveForm::begin(); ?>
    
	<?php
	$user= User::find()->all();
	$listData=ArrayHelper::map($user,'id','first_name');
	?>

    <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>
<?php
echo Tabs::widget([
    'items' => [
        [
            'label' => 'Status',
            'content' => $this->render('message', [
                'model' => $model,
            ]),
            'active' => true
        ],
        [
            'label' => 'Add Picture',
            'content' => $this->render('image', [
                'model' => $model,
            ]),
           // 'headerOptions' => [...],
            'options' => ['id' => 'myveryownID'],
        ],
		[
            'label' => 'Add Video',
            'content' => $this->render('video', [
                'model' => $model,
            ]),
			//'url' => 'http://www.example.com',
           // 'headerOptions' => [...],
           // 'options' => ['id' => 'myveryownID'],
        ],
        
    ],
]);
?>
    
    
    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'totalvotetodelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>


