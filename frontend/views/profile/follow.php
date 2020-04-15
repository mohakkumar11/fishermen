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
use yii\widgets\LinkPager;
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
.footy-sec{
	position:fixed;
	bottom:0px;
	background:#fff;}
	

</style>
</head>
<body oncontextmenu="zreturn false;">
	<div class="container">
<div class="follow_section tbl_wd">
			<br>
<br>
<br>
<br><br>
<br>
<main>
<section class="companies-info">
<div class="container">
<!--<div class="company-title">
<h3>All Companies</h3>
</div>--><!--company-title end-->
<div class="companies-list">
<div class="row">
<?php
//echo '<pre>'; print_r($dataReader);die;
 foreach($dataReader as $data) { ?>
<div class="col-lg-3 col-md-4 col-sm-6 col-12">
<div class="company_profile_info">
<div class="company-up-info">
<?php if($data['user_pic'] != ''){ ?>
<img src="<?php echo Yii::$app->request->baseUrl.'/admin/images/user/'.$data['user_pic']; ?>" alt="">
<?php } else{ ?>
<img src="<?php echo Yii::$app->request->baseUrl.'/admin/images/user/blank-profile-picture-973460_640.png'; ?>" alt="">
<?php } ?>
<h3> <?php echo $data['first_name'];?> </h3>
</div>
<!--<a href="#" title="" class="view-more-pro">View Profile</a>-->
</div><!--company_profile_info end-->
</div>
<?php } ?>
<?php
echo LinkPager::widget([
    'pagination'=>$dataProviders->pagination,
]);
?>

</div>
</div><!--companies-list end-->
<div class="process-comm">
<div class="spinner">
<div class="bounce1"></div>
<div class="bounce2"></div>
<div class="bounce3"></div>
</div>
</div><!--process-comm end-->
</div>
</section>
</main>
</div>
</div>
</body>
</html>