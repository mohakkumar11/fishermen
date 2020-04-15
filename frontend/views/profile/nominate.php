<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use admin\models\User;
use admin\models\Post;
use kartik\file\FileInput;
use yii\bootstrap\Progress;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use admin\models\Categories;
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
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>WorkWise Html Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
<style>

#formContent  {
    border: 1px solid #732699;
	padding:15px;
	margin-top:50px;
	margin-bottom:150px;
}
#formContent select {
    border: 1px solid #732699;
}

.sbn_btn {
    color: #ffffff;
    font-size: 16px;
     background-color: #804d99;
        border-color: #732699;
    padding: 12px 27px;
    border: 0;
    font-weight: 500;
    margin-top: 30px;
    cursor: pointer;
}
.violet_fnt{
	color: #804d99;
}



.form-group.field-user-countryid label.control-label {
	display:none;
}
</style>
</head>
<body oncontextmenu="zreturn false;">
	<div class="container">
    <div class="wrapper fadeInDown">
  <div id="formContent">
    <!-- Tabs Titles -->
    <!-- Icon -->
    <div class="fadeIn first">
      
	    <h3 class="violet_fnt"> Nominate Leader</h3>
    </div>
    <!-- Login Form -->
       <?php $form = ActiveForm::begin([
	  'id' => 'nominate_form'
	  ]);?>
       <?php
	$countries= Country::find()->orderBy([
  'name'=>SORT_ASC
])->all();
	$listData=ArrayHelper::map($countries,'id','name');
	?>
    <?= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => '--Select Country--', 'class' => 'inp_second form-control', 'required' => true]) ?>
    <?php
	$categories= Categories::find()->orderBy([
  'name'=>SORT_ASC
])->all();
	$listData=ArrayHelper::map($categories,'id','name');
	?>
    <?= $form->field($model1, 'category')->dropDownList($listData, ['prompt' => 'Select Categories', 'class' => 'inp_second form-control', 'required' => true])->label(false); ?>
	
    <?= $form->field($model1, 'leader_name')->textInput(['placeholder'=> 'Type here Leader Name', 'class' => 'inp_second form-control', 'required' => true])->label(false); ?>
	    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>  
           <?php
		  /* echo AutoComplete::widget([
    'model' => $model,
    'attribute' => 'leader_name',
    'clientOptions' => [
    'source' => ['1','2'],
     ],
    ]);*/
		   ?>
     <div id="leaderList"></div>  
	   
	   
	   
   <?= Html::submitButton('Nominate As Leader' , ['class' => 'btn sbn_btn center-block']) ?>
                 <?php ActiveForm::end(); ?>
                 <br>
                 <p style="color:red;"> Note: Each Leader must have 1000 nominations to be invited to post on jijigram. </p>
<br>
  </div>
  
  
</div>
</div>
</body>
</html>
 <script>  
 $(document).ready(function(){  
      $('#nominateleader-leader_name').keyup(function(){  
           var query = $(this).val(); 
		   var country = $('#user-countryid').val();
		   var category = $('#nominateleader-category').val();
           
           if(query != '')  
           {  
                $.ajax({  
                     url:"search.php", 
					 //"url" : "nominateleader-search", 
                     method:"POST",  
                     data:{query:query, country:country, category:category},  
                     success:function(data)  
                     {  
                          $('#leaderList').fadeIn();  
                          $('#leaderList').html(data);  
                     }  
                });  
           }  
      });  
      $(document).on('click', 'li', function(){  
           $('#nominateleader-leader_name').val($(this).text());  
           $('#leaderList').fadeOut();  
      });  
 });  
 </script>