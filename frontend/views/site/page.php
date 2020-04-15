<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use admin\models\User;
use admin\models\Post;
use kartik\file\FileInput;
use frontend\models\RequestDelete;
use frontend\models\FollowerDetails;
use yii\bootstrap\Progress;
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

//foreach($sql as $row)
		//{
			$title = $sql['title'];
			$description = $sql['description'];
			
		//}
		?>
 <div class="container">
 <section class="banner banner_inner"><!--banner-->
  <h1><?php echo $title;?></h1>
  <div class="help_pages">
          <h1><?php echo $description;?></h1>
        </div> 
</section>
</div>


<style>
.help_pages{
	margin-bottom:380px;
	
	}
</style>