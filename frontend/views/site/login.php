<?php
/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model \common\models\LoginForm */
 
 
 
use admin\models\User;
use admin\models\Post;
use kartik\file\FileInput;
use yii\bootstrap\Progress;
use yii\widgets\ListView;
use yii\grid\GridView;
use yii\helpers\ArrayHelper;
use common\models\Country;
use admin\models\Categories;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\bootstrap\ActiveForm;
$this->registerCssFile("@web/css/bootstrap.min.css");
$this->registerCssFile("@web/css/font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
$this->registerCssFile("@web/css/line-awesome.css");
$this->registerCssFile("@web/css/style.css");
$this->registerCssFile("@web/css/line-awesome-font-awesome.min.css");
?>
<link rel="stylesheet" type="text/css" href="css/bootstrap.min">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<body class="sign-in" oncontextmenu="zreturn false;">
<div class="wrapper">
		<div class="sign-in-page">
			<div class="signin-popup">
				<div class="signin-pop">
					<div class="flx_row">
						<div class="col-lg-6 zzcol-md-12 col-sm-12 col-xs-12" style="background: #732699; border-radius: 4px 0px 0px 4px;">
							<div class="cmp-info">
								<div class="cm-logo">
                                    <div class="logn_im_cnt"><img class="img-responsive" src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram-logo.png'; ?>" alt=""></div>
                                    <div class="clearfix"></div>
									<!-- <h3>Leader to Leader. </h3>
                                    <h3>Follow the Leaders.</h3>-->
                                     <h3> Nominate the leaders. </h3>
                                    <h3>Control the conversation.</h3> <br>                                  
									<!--<h3> This week's most nominated leaders. </h3>-->
                                    <!--<h3>The power to delete.</h3>
                                    <h3>Always espionage free.</h3>-->
                                    <br>

									<!--<div class=" row text-center">
									
									
 									</div>-->
 								</div>
<div class=" nomini_qty">								 
<h3>How many nominations do I have?</h3>


 <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" />  
           <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>  
           <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script> 
</div>		   
							</div><!--cmp-info end-->
						</div>
						<div class="col-lg-6 zzcol-md-12 col-sm-12  col-xs-12">
							<div class="login-sec">
                            <div class="col-lg-12">
                            <div class="row">
                            <ul class="anch_sign-control ledr_btn">
									<li zdata-tab="tab-a3"><a href="<?php echo Url::to(['site/rsvp']);?>" title="">Leader RSVP</a></li>
                                    <p><a href="" title=""> Sign Up by invitation only.
</a></p>				
								</ul>
                            </div>
                            </div>
								<ul class="zzsign-control anch_sign-control  mar_50 zledr_btn">
									<li data-tab="tab-2"><?= Html::a('Join', ['site/signup'],['class' => ' jn_bt']) ?><span  class="con_tele_hdr"> jijigram today.</span></li>				
								</ul>			
								<div class="sign_in_sec current" id="tab-1">
                                    <?php $form = ActiveForm::begin();?>
										<div class="row">
											<div class="col-lg-12  col-sm-12  col-xs-12 no-pdd">
												<div class="sn-field">
                                                     <p class="smb_fnt">  <?= $form->field($model, 'username')->textInput(['maxlength' => true,  'placeholder' => ' Username'])->label(false); ?></p>
												</div><!--sn-field end-->
											</div>
											<div class="col-lg-12  col-sm-12  col-xs-12 no-pdd">
												<div class="sn-field">
                                                   <p class="pwsmb_fnt">    <?= $form->field($model, 'password')->passwordInput(['placeholder' => "Password"])->label(false); ?></p>
													<!--<i class="la la-lock"></i>-->
												</div>
											</div>
											<div class="col-lg-12   col-sm-12  col-xs-12no-pdd">
												<div class="checky-sec">
													<div class="zzfgt-sec">
                                                        <div class="col-sm-6">
                                                         <?= $form->field($model, 'rememberMe')->checkbox(['class' => 'logincheckbox']) ?></div>
                                                            <div class="col-sm-6 text-right"> <span style="padding-top: 10px; display: inline-block;"><?= Html::a('Forgot Password?', ['site/request-password-reset']) ?></span></div>
													</div><!--fgt-sec end-->
												</div>
											</div>
                                            <div class="col-lg-12  col-sm-12  col-xs-12 no-pdd frm_logo">
                                      <?= Html::submitButton( 'Login', ['class' => 'btn btn-primary' , 'value'=>'Create']) ?>
											</div
										></div>
									<!--</form>-->
                                    <?php ActiveForm::end(); ?>
								</div><!--sign_in_sec end-->
							</div><!--login-sec end-->
						</div>
						<div class="clearfix"></div>
					</div>		
				</div><!--signin-pop end-->
			</div><!--signin-popup end-->
			<!--footy-sec end-->
		</div><!--sign-in-page end-->
	</div>
</body>

<script>  
 $(document).ready(function(){  
      $('#nominateleader-leader_name').keyup(function(){  
           var query = $(this).val(); 
		  
           
           if(query != '')  
           {  
                $.ajax({  
                     url:"homesearch.php", 
					 //"url" : "nominateleader-search", 
                     method:"POST",  
                     data:{query:query},  
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