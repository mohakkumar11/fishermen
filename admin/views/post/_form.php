<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use sadovojav\ckeditor\CKEditor;
use yii\helpers\ArrayHelper;
use admin\models\User;
use yii\widgets\Pjax;

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
	 $(function() {
  var $tabButtonItem = $("#tab-button li"),
      $tabSelect = $("#tab-select"),
      $tabContents = $(".tab-contents"),
      activeClass = "is-active";

  $tabButtonItem.first().addClass(activeClass);
  $tabContents.not(":first").hide();

  $tabButtonItem.find("a").on("click", function(e) {
    var target = $(this).attr("href");

    $tabButtonItem.removeClass(activeClass);
    $(this).parent().addClass(activeClass);
    $tabSelect.val(target);
    $tabContents.hide();
    $(target).show();
    e.preventDefault();
  });

  $tabSelect.on("change", function() {
    var target = $(this).val(),
        targetSelectNum = $(this).prop("selectedIndex");

    $tabButtonItem.removeClass(activeClass);
    $tabButtonItem.eq(targetSelectNum).addClass(activeClass);
    $tabContents.hide();
    $(target).show();
  });
});		
  $("#my_form_id").on("submit", function() {
            var form = $(this); 
			e.preventDefault();
            // return false if form still have some validation errors
            if (form.find(".has-error").length) 
            {
                return false;
            }
            // submit form
            $.ajax({
            "type" : "POST",
            "url" : "create",
            data   : form.serialize(),
            success: function (data) 
            {
				 document.getElementById("my_form_id").reset();
				 alert("Data was succesfully captured");
				 $.pjax.reload({container: "#postIndex", async: false});
            },
            error  : function () 
            {
                console.log("internal server error");
            }
            });
            return false;
         }); 
		});'
	
    );

?>

<div class="post-form">
 <?php Pjax::begin(); ?>
    <?php $form = ActiveForm::begin( [
	//'action' => 'index',
        //'method' => 'post',
        'id' => 'my_form_id',
		 'enableAjaxValidation' => false,
		 'enableClientValidation' => true,
		 'options' => ['enctype' => 'multipart/form-data']
   // 'validationUrl' => 'validation-rul',
]); 
   ?>
	<?php
	$user= User::find()->all();
	$listData=ArrayHelper::map($user,'id','first_name');
	?>
      <?= $form->field($model, 'userId')->dropDownList($listData, ['prompt' => 'Select User']) ?>
        <div class="to_recipient">
              <?= $form->field($model, 'to_address')->textarea(['rows' => 4])->label("To( Recipient's Name & address ):"); ?>
                                             </div>
	<div class="tabs">
  <div class="tab-button-outer">
    <ul id="tab-button">
      <li><a href="#tab01">Status</a></li>
      <li><a href="#tab02">Add Picture</a></li>
      <li><a href="#tab03">Add Video</a></li>
    
    </ul>
  </div>
  

  <div id="tab01" class="tab-contents">
   <!-- <h2>Tab 1</h2>-->
  <?= $form->field($model, 'message')->textarea(['rows' => 4])->label(false); ?>
  </div>
  <div id="tab02" class="tab-contents">
   <!-- <h2>Tab 2</h2>-->
    <?= $form->field($model, 'image_messge')->textarea(['rows' => 4])->label(false); ?>
  <?= $form->field($model, 'imagename')->fileInput(['accept' => 'image/*'])->label(false); ?> 
  <span id="image-holder"> </span>
</div>
   
    <?php if($model->imagename!=''){?>
     		<div><img src="<?= Yii::$app->request->baseUrl.'/images/postImage/'.$model->imagename ?>" height="150" width="200"/></div>
		<?php } ?>

  <div id="tab03" class="tab-contents">
   <!-- <h2>Tab 3</h2>-->
  <?= $form->field($model, 'video_message')->textarea(['rows' => 4])->label(false); ?>
   <?= $form->field($model, 'videoname')->fileInput(['accept' => 'video/mp4', 'class' => 'file_multi_video', 'onchange'=>'document.getElementById("preview").src = window.URL.createObjectURL(this.files[0])'])->label(false); ?>
    
     <?php if($model->videoname!=''){?>
      <video style="border:1px solid" id="preview" width="200" height="150" controls >
      	<source src="<?= Yii::$app->request->baseUrl.'/videos/postVideo/'.$model->videoname ?>" type="video/mp4">
      </video>   		
		<?php } ?>
        <video id ="preview" width="200" height="150" controls>
  <source src="video.mp4" type="video/mp4">
  <source src="video.ogg" type="video/ogg">
 <source src="video.webm" type="video/webm">
Your browser does not support the video tag.
</video>
  </div>
   </div>

    <?= $form->field($model, 'status')->dropDownList([ 'Y' => 'Yes', 'N' => 'No', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'totalvotetodelete')->textInput() ?>

    <div class="form-group">
        <?= Html::submitButton('Post', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>
<?php Pjax::end(); ?>
</div>
<style>
body {
  font-family: 'Open Sans', sans-serif;
  font-weight: 300;
}
.tabs {
  max-width: 100%;
  margin: 0 auto;
  padding: 0 20px;
}
#tab-button {
  display: table;
  table-layout: fixed;
  width: 100%;
  margin: 0;
  padding: 0;
  list-style: none;
}
#tab-button li {
  display: table-cell;
  width: 20%;
}
#tab-button li a {
  display: block;
  padding: .5em;
  background: #eee;
  border: 1px solid #ddd;
  text-align: center;
  color: #000;
  text-decoration: none;
}
#tab-button li:not(:first-child) a {
  border-left: none;
}
#tab-button li a:hover,
#tab-button .is-active a {
  border-bottom-color: transparent;
  background: #fff;
}
.tab-contents {
  padding: .5em 2em 1em;
  border: 1px solid #ddd;
}



.tab-button-outer {
  display: none;
}
.tab-contents {
  margin-top: 20px;
}
@media screen and (min-width: 768px) {
  .tab-button-outer {
    position: relative;
    z-index: 2;
    display: block;
  }
  .tab-select-outer {
    display: none;
  }
  .tab-contents {
    position: relative;
    top: -1px;
    margin-top: 0;
  }
}
</style>

