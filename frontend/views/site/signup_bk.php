<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \frontend\models\SignupForm */

use yii\helpers\Url;
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
$this->registerJs("
$(document).ready(function() {
	$('#submit').attr('disabled', true);
$('#signupForm input').on('change', function() {
	var yes = $('input[name=cc]:checked', '#signupForm').val();
		 if(yes == 'on') {
           $('#submit').attr('disabled', false);
        }
		
});
});");
    //use app\models\Country;
	$countries= Country::find()->all();
	
	 
	$listData=ArrayHelper::map($countries,'id','name');
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
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
                            
                            <div class="col-lg-12">
                            <div class="row">
                            <ul class="anch_sign-control ledr_btn">
													
									<li zdata-tab="tab-a3"><a href="<?php echo Url::to(['site/rsvp']);?>" title="">Leader RSVP</a></li>


                                    <p><a href="" title="">Sign Up by invitation only.
</a></p>				
								</ul>
                            </div>
                            </div>
								<ul class="anch_sign-control">
									<li><?= Html::a('Login', ['site/login']) ?></li>				
									<li class=" current"><a href="#" title="">Join</a></li>
                                    				
								</ul>			
								<div class="sign_in_sec" id="tab-1">
									<h2 class="con_tele_hdr">Join Real-Time Telegram today.</h2>
									<h3>Sign in</h3>
									<form>
										<div class="row">
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="text" name="username" placeholder="Username">
													<i class="la la-user"></i>
												</div><!--sn-field end-->
											</div>
											<div class="col-lg-12 no-pdd">
												<div class="sn-field">
													<input type="password" name="password" placeholder="Password">
													<i class="la la-lock"></i>
												</div>
											</div>
											<div class="col-lg-12 no-pdd">
												<div class="checky-sec">
													<div class="fgt-sec">
														<input type="checkbox" name="cc" id="c1">
														<label for="c1">
															<span></span>
														</label>
														<small>Remember me</small>
													</div><!--fgt-sec end-->
													<a href="#" title="">Forgot Password?</a>
												</div>
											</div>
											<div class="col-lg-12 no-pdd">
												<button type="submit" value="submit">Sign in</button>
											</div>
										</div>
									</form>
									 
								</div><!--sign_in_sec end-->
								<div class="sign_in_sec  current" id="tab-2">
                                <h2 class="ledr_dtls">Join Real-Time Telegram today.</h2>
									<!--<div class="signup-tab">
										<i class="fa fa-long-arrow-left"></i>
										<h2>Enter Your details bellow</h2>
										<ul>
											<li data-tab="tab-3" class="current"><a href="#" title="">User</a></li>
											<li data-tab="tab-4"><a href="#" title="">Company</a></li>
										</ul>
									</div>--><!--signup-tab end-->	
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
														<!--<i class="fa fa-at"></i>-->
														<!--<span><i class="fa fa-ellipsis-h"></i></span>-->
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<!--<input type="text" name="country" placeholder="Country">-->
                                                        <p class="cun_fnt"> <?= $form->field($model, 'countryId')->dropDownList($listData, ['prompt' => '--Choose Country--'])->label(false); ?> </p>
														<!--<i class="la la-globe"></i>-->
													</div>
												</div>
												
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<!--<input type="password" name="password" placeholder="Password">-->
                                                      <p class="pwsmb_fnt">  <?= $form->field($model, 'password_hash')->passwordInput(['placeholder' => "Password"])->label(false); ?> </p>
														
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<!--<input type="password" name="repeat-password" placeholder="Repeat Password">-->
                                                       <p class="pwsmb_fnt">  <?= $form->field($model, 'confirm_password')->passwordInput(['placeholder' => "Repeat Password"])->label(false);  ?> </p>
														<!--<i class="la la-lock"></i>-->
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="checky-sec st2">
														<div class="fgt-sec">
															<input type="checkbox" name="cc" id="c2">
															<label for="c2">
																<span></span>
															</label>
															<small>Yes, I understand and agree to the Real-Time Telegram  Terms &amp; Conditions.
															<a href="" data-toggle="modal" data-target="#myModal">Click Here</a>
															 
														   <div class="modal fade" id="myModal" role="dialog">
															<div class="modal-dialog">
															   <div class="modal-content">
																<div class="modal-header">
																  
																  <h4 class="modal-title">Terms &amp; Conditions</h4>
																</div>
																<div class="modal-body">
																  <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam luctus hendrerit metus, </p>
																</div>
																<div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
															   </div>
															 </div>
														  </div>
															</small>
														</div><!--fgt-sec end-->
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<button type="submit" value="submit" id="submit">Get Started</button>
												</div>
											</div>
                                            <?php ActiveForm::end(); ?>
										<!--</form>-->
									</div>
                                    
                                    <!--dff-tab end-->
									<!--<div class="dff-tab" id="tab-4">
										<form>
											<div class="row">
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" name="company-name" placeholder="Company Name">
														<i class="la la-building"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="text" name="country" placeholder="Country">
														<i class="la la-globe"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" name="password" placeholder="Password">
														<i class="la la-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="sn-field">
														<input type="password" name="repeat-password" placeholder="Repeat Password">
														<i class="la la-lock"></i>
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<div class="checky-sec st2">
														<div class="fgt-sec">
															<input type="checkbox" name="cc" id="c3">
															<label for="c3">
																<span></span>
															</label>
															<small>Yes, I understand and agree to the workwise Terms &amp; Conditions.</small>
														</div>fgt-sec end
													</div>
												</div>
												<div class="col-lg-12 no-pdd">
													<button type="submit" value="submit">Get Started</button>
												</div>
											</div>
										</form>
									</div>--><!--dff-tab end-->
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