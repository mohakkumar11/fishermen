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
/*a {
  color: #92badd;
  display:inline-block;
  text-decoration: none;
  font-weight: 400;
}

h2 {
  text-align: center;
  font-size: 16px;
  font-weight: 600;
  text-transform: uppercase;
  display:inline-block;
  margin: 40px 8px 10px 8px; 
  color: #cccccc;
}*/



/* STRUCTURE */

.wrapper {
  display: flex;
  align-items: center;
  flex-direction: column; 
  justify-content: center;
  width: 100%;
  min-height: 100%;
  padding: 20px;
}

#formContent {
  -webkit-border-radius: 10px 10px 10px 10px;
  border-radius: 10px 10px 10px 10px;
  background: #fff;
  padding: 30px;
  width: 90%;
  max-width: 450px;
  position: relative;
  padding: 0px;
 /* -webkit-box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);
  box-shadow: 0 30px 60px 0 rgba(0,0,0,0.3);*/
  text-align: center;
}

#formFooter {
  background-color: #f6f6f6;
  border-top: 1px solid #dce8f1;
  padding: 25px;
  text-align: center;
  -webkit-border-radius: 0 0 10px 10px;
  border-radius: 0 0 10px 10px;
}



/* TABS */

h2.inactive {
  color: #cccccc;
}

h2.active {
  color: #0d0d0d;
  border-bottom: 2px solid #5fbae9;
}



/* FORM TYPOGRAPHY*/

input[type=button], input[type=submit], input[type=reset],   {
  background-color: #56baed;
  border: none;
  color: white;
  padding: 15px 80px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  text-transform: uppercase;
  font-size: 13px;
  -webkit-box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  box-shadow: 0 10px 30px 0 rgba(95,186,233,0.4);
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
  margin: 5px 20px 40px 20px;
  -webkit-transition: all 0.3s ease-in-out;
  -moz-transition: all 0.3s ease-in-out;
  -ms-transition: all 0.3s ease-in-out;
  -o-transition: all 0.3s ease-in-out;
  transition: all 0.3s ease-in-out;
}

input[type=button]:hover, input[type=submit]:hover, input[type=reset]:hover  {
  background-color: #39ace7;
}

input[type=button]:active, input[type=submit]:active, input[type=reset]:active  {
  -moz-transform: scale(0.95);
  -webkit-transform: scale(0.95);
  -o-transform: scale(0.95);
  -ms-transform: scale(0.95);
  transform: scale(0.95);
}

.inp_second {
  background-color: #f6f6f6;
  border: none;
  color: #0d0d0d;
  padding: 15px 32px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 16px;
  margin: 5px;
  width: 85%;
  border: 2px solid #f6f6f6;
  -webkit-transition: all 0.5s ease-in-out;
  -moz-transition: all 0.5s ease-in-out;
  -ms-transition: all 0.5s ease-in-out;
  -o-transition: all 0.5s ease-in-out;
  transition: all 0.5s ease-in-out;
  -webkit-border-radius: 5px 5px 5px 5px;
  border-radius: 5px 5px 5px 5px;
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

input[type=text]:focus {
  background-color: #fff;
  border-bottom: 2px solid #5fbae9;
}

input[type=text]:placeholder {
  color: #cccccc;
}



/* ANIMATIONS */

/* Simple CSS3 Fade-in-down Animation */



/* Simple CSS3 Fade-in Animation */
.underlineHover:after {
  display: block;
  left: 0;
  bottom: -10px;
  width: 0;
  height: 2px;
  background-color: #56baed;
  content: "";
  transition: width 0.2s;
}

.underlineHover:hover {
  color: #0d0d0d;
}

.underlineHover:hover:after{
  width: 100%;
}



/* OTHERS */

*:focus {
    outline: none;
} 

#icon {
  width:60%;
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
	$countries= Country::find()->all();
	$listData=ArrayHelper::map($countries,'id','name');
	?>
    <?= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => '--Select Country--', 'class' => 'inp_second']) ?>
    <?php
	$categories= Categories::find()
	->all();
	$listData=ArrayHelper::map($categories,'id','name');
	?>
    <?= $form->field($model1, 'categoryId')->dropDownList($listData, ['prompt' => 'Select Categories', 'class' => 'inp_second'])->label(false); ?>
    <?php
	$leaderDetails = User::find()
	->where('usertype = "L"')
	->all();
	$leader = array();
	foreach($leaderDetails as $led){
		$countRow = Yii::$app->db->createCommand('SELECT COUNT(*) as total FROM nominate WHERE leaderID ='.$led->id)->queryColumn();
		$leader[] = $led->first_name.' ( '.$countRow[0].' Nominated )';
		}
	?>
    <?= Html::activeDropDownList($model, 'id',
     $leader,[
       'class' => 'inp_second',
	   'prompt'=>'--Choose Leader--',
	   'required'=>true
 ]) 
	  ?>
   <?= Html::submitButton('Nominate As Leader' , ['class' => 'btn sbn_btn']) ?>
                 <?php ActiveForm::end(); ?>
<br>
  </div>
</div>
</div>
</body>
</html>