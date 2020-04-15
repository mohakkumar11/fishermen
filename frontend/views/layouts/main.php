<?php
/* @var $this \yii\web\View */
/* @var $content string */
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\widgets\ActiveForm;
use common\widgets\Alert;
use manage\models\Slider;
use manage\models\Settings;
AppAsset::register($this);
$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/responsive.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
?>

<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
  
</head>

<body>
<?php $this->beginBody() ?>
<?php $request_url = $_SERVER['REQUEST_URI'];
	if(Yii::$app->user->identity != ''){
?>
<header>
			<div class="container">
				<div class="header-data">
					<div class="logo">
                    <?php if(Yii::$app->user->identity->usertype == 'F') {  ?>
                    <a href="<?= Yii::$app->urlManager->createUrl(['profile/my-channels']);?>" title=""><img src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram-logo.png'; ?>" alt=""></a>
                    <?php } else{ ?>
						<a href="<?= Yii::$app->urlManager->createUrl(['profile/my-post']);?>" title=""><img src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram-logo.png'; ?>" alt=""></a>
						 <?php } ?>
					</div><!--logo end-->
                     <?php if(Yii::$app->user->identity->usertype == 'F') {  ?>
					<div class="search-bar">
						<?php $form = ActiveForm::begin([
						'action' => ['profile/search'],
						'method' => 'post',
						'id' => 'searchForm'
					]); ?>
							<input type="text" name="search" placeholder="Search...">
							<button type="submit"><i class="la la-search"></i></button>
						<?php ActiveForm::end(); ?>
					</div><!--search-bar end-->
                    <?php } ?>
                    <div class="user-account">
						<div class="user-info">
							<!--<img src="images/resources/brk.png" alt="">-->
							<a href="#" title=""><?= substr(Yii::$app->user->identity->first_name,0,6);?></a>
							<i class="la la-sort-down"></i>
						</div>
						<div class="user-account-settingss">
							
                            <ul class="us-links">
							
								<li><a href="<?= Yii::$app->urlManager->createUrl(['profile/update?id='.Yii::$app->user->identity->id]);?>" title="">My Profile</a></li>
	
								
								
								<li><a href="<?php echo Url::to(['default/index', 'uid' => Yii::$app->user->identity->id]);?>" title="">Change Password</a></li>
							
							</ul>
							<h3 class="tc"> <?php echo Html::beginForm(['/site/logout'], 'post')
            . Html::submitButton(
                'Logout (' . substr(Yii::$app->user->identity->first_name,0,6) . ')',
                ['class' => 'btn btn-link logout', 'style' => 'color: #804d99;' ]
            )
            . Html::endForm()
			?>	</a></h3>
						</div><!--user-account-settingss end-->
					</div>
                    
					<nav>
						<ul>
							<li>
                            <?php if(Yii::$app->user->identity->usertype == 'F') {  ?>
								<a href="<?= Yii::$app->urlManager->createUrl(['profile/my-channels']);?>" title="">
                                <?php } else{?>
                                <a href="<?= Yii::$app->urlManager->createUrl(['profile/my-post']);?>" title="">
                                <?php } ?>
									<!--<span><img src="images/icon1.png" alt=""></span>-->
									Home
								</a>
							</li>
							<li>
                            <?php if(Yii::$app->user->identity->usertype == 'F') {  ?>
								<a href="<?= Yii::$app->urlManager->createUrl(['profile/nominate?id='.Yii::$app->user->identity->id]);?>" title="" class="not-box-open">
									<!--<span><img src="images/icon7.png" alt=""></span>-->
									Nominate
								</a>
								<?php } ?>
								
							</li>
                           
						</ul>
					</nav><!--nav end-->
					<div class="menu-btn">
						<a href="#" title=""><i class="fa fa-bars"></i></a>
					</div><!--menu-btn end-->
					
				</div><!--header-data end-->
			</div>
		</header><!--header end-->		
<?php }  ?>
<?= Breadcrumbs::widget([
	'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
]) ?>
<?= Alert::widget() ?>
<?= $content ?>




<footer>
			<div class="footy-sec mn no-margin">
				<div class="container">
					<ul style="width:100%;">
						<li><a href="<?php echo Url::to(['site/pages', 'page' => 'help']);?>" title="">Help Center</a></li>
						<li><a href="<?php echo Url::to(['site/pages', 'page' => 'privacy']);?>" title="">Privacy Policy</a></li>
                        <li><a href="<?php echo Url::to(['site/contact-us']);?>" title="">Contact Us</a></li>
						<li style="border: none;"><a href="<?php echo Url::to(['site/pages', 'page' => 'conduct']);?>" title=""></i>Code Of Conduct</a></li>
                        <li style="float: right;"><a href="#" title=""><i class="la la-copyright"></i>Copyright 2018</a></li>
					</ul>
					
					 
				</div>
			</div>
		</footer><!--footer end-->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script> 
<?php
$this->registerJsFile('@web/bootstrap-js/bootstrap.min.js');
$this->registerJsFile('@web/js/jquery.meanmenu.js');
$this->registerJsFile('@web/js/responsiveslides.min.js');
$this->registerJsFile('@web/js/owl.carousel.js');

?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>