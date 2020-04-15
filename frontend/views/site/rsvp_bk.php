<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use admin\models\User;
use common\models\Country;
use yii\helpers\ArrayHelper;

 
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/bootstrap.min.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
$this->registerCssFile("@web/fonts/line-awesome-font-awesome.min.css");

    //use app\models\Country;
	$countries= Country::find()->all();
	
	 
	$listData=ArrayHelper::map($countries,'id','name');
?>
<?php /*?><?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?><?php */?>
<link rel="stylesheet" type="text/css" href="css/animate.css">
<link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome.css">
<link rel="stylesheet" type="text/css" href="css/line-awesome-font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="css/font-awesome.min.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick.css">
<link rel="stylesheet" type="text/css" href="lib/slick/slick-theme.css">
<link rel="stylesheet" type="text/css" href="css/style.css">
<link rel="stylesheet" type="text/css" href="css/responsive.css">

<style>

.top_bbl:before {
    content: '';
    position: absolute;
    top: -16px;
    left: 100px;
    width: 30px;
    height: 30px;
    background-color: #fff;
    -moz-border-radius: 100px;
    -ms-border-radius: 100px;
    -o-border-radius: 100px;
    border-radius: 100px;
}

.top_bbl:after {
    content: '';
    position: absolute;
    top: -37px;
    left: 83px;
    width: 20px;
    height: 20px;
    background-color: #fff;
    -webkit-border-radius: 100px;
    -moz-border-radius: 100px;
    -ms-border-radius: 100px;
    -o-border-radius: 100px;
    border-radius: 100px;
}
</style>
<body class="sign-in" oncontextmenu="zreturn false;">
<div class="wrapper">
		<div class="login_for_ledr">

		<div class="sign-in-page">
			<div class="zsignin-popup col-xs-12 zcol-xs-offset-2  col-sm-8 col-sm-offset-3 col-md-6 col-md-offset-3 col-lg-6 col-lg-offset-3 top_bbl">
				<div class="signin-pop">
					<div class="row">
						
						<div class="col-lg-12 zcol-lg-offset-3">
							<div class="login-sec">
                            <ul class="anch_sign-control">
									<li><?= Html::a('Login', ['site/login']) ?></li>
                                    <li data-tab="tab-2"><?= Html::a('Join', ['site/signup'],['class' => ' jn_bt']) ?><span  class="con_tele_hdr"></span></li>				

                                    				
								</ul>
                   
                          	<div class="sign_in_sec  current" id="tab-2">
                                <h2 class="ledr_dtls">Leader RSVP Form </h2>
									
									<div class="dff-tab current" id="tab-3">
										<!--<form>-->
                                         <?php $form = ActiveForm::begin([ 'id' => 'signupForm']);?>
											<div class="row">                                           
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
													  <p class="smb_fnt">	 <?= $form->field($model, 'first_name')->textInput(['maxlength' => true,'placeholder' => "Full Name"])->label(false); ?> </p>
														<!--<i class="la la-user"></i>
-->													</div>
												</div>
                                                
                                                <div class="col-lg-12 no-pdd">
													<div class="sn-field">
													<p class="em_fnt">	<?= $form->field($model, 'email')->textInput(['maxlength' => true,'placeholder' => "Email"])->label(false); ?> </p>
														
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">		
                                                        <p class="cun_fnt"> <?= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => '--Choose Country--'])->label(false); ?> </p>
														
													</div>
												</div>
												<?php /*?><div class="col-lg-12 no-pdd">
													<div class="sn-field">		
                                                        <p class="cun_fnt"> <?= $form->field($model, 'usertype')->dropDownList(['L' => 'Leader', 'F' => 'Follower'], ['prompt' => '--Choose User Type--'])->label(false); ?> </p>
													
													</div>
												</div><?php */?>
												<div class="col-lg-12 no-pdd">
													<?= Html::submitButton( 'Submit', ['class' => 'btn btn-primary' , 'value'=>'Create']) ?>
                                                     												</div>
											</div>
                                            <?php ActiveForm::end(); ?>
										<!--</form>-->
									</div>                                
								</div>
                                
                                		
							</div><!--login-sec end-->
						</div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->          
            <!--footy-sec end-->
		</div><!--sign-in-page end-->
</div>

	</div>
</body>