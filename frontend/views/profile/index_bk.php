<?php
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\helpers\Url;
use admin\models\User;
use admin\models\Post;
use kartik\file\FileInput;
use yii\bootstrap\Progress;
use yii\bootstrap\Button;
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
$this->registerJs(
    '$("document").ready(function(){
		 $(".file-preview ").hide();
				$("#post-imagename").on("change", function() {
					 $(".file-preview").show();	
				});
				$("#post-videoname").on("change", function() {
					 $(".file-preview").show();	
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
   $("#post-to_address").keyup(function(){
		var address = $(this).val();
		$.ajax({
            "type" : "GET",
            "url" : "find",
            "data"   : {address: address},
            success: function (data) 
            {
				console.log(data);
				 alert(data);
            },
            error  : function () 
            {
                console.log("internal server error");
            }
            });          
         }); 
});		
 $(".follow").click(function(){
  var $this = $(this);
  $this.toggleClass("following")
  if($this.is(".following")){
    $this.addClass("wait");
  }
}).on("mouseleave",function(){
  $(this).removeClass("wait");
})
		});'
    );
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>WorkWise Html Template</title>
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta name="description" content="" />
<meta name="keywords" content="" />
</head>
<body oncontextmenu="zreturn false;">
	<div class="wrapper">
		<section class="cover-sec">
        <?php if(Yii::$app->user->identity->usertype != 'F') {  ?>
			<a href="<?= Yii::$app->urlManager->createUrl(['profile/index']);?>" title=""><i class="fa fa-camera"></i>POST</a>
            <?php } ?>
		</section>
		<main>
			<div class="main-section">
				<div class="container">
					<div class="main-section-data">
						<div class="row">
							<div class="col-lg-12">
								<div class="main-ws-sec">
                                 <?php if(Yii::$app->user->identity->usertype != 'L') {  ?>
                                    <div class="channels">
                                    <a href="<?= Yii::$app->urlManager->createUrl(['profile/public-channels']);?>" title="">Public Channel </a>
                                     <a href="<?= Yii::$app->urlManager->createUrl(['profile/my-channels']);?>" title="">My Channel </a>
                                     </div>
                                    <?php } ?>
									<div class="product-feed-tab current" id="feed-dd">
                                    <?php if(Yii::$app->user->identity->usertype == 'L') { ?>
									<div class="tab_post_profile" style="background:#fff;">
									  <?php $form = ActiveForm::begin([
											'id' => 'statusFrom',
											 'enableAjaxValidation' => false,
											 'enableClientValidation' => true,
												 'options' => ['enctype' => 'multipart/form-data']
										 ]); 
										   ?>
                                           <div class="col-sm-8 to_recipient">
                                              <?= $form->field($model, 'to_address')->textInput()->label("To (Recipient's Name & address):"); ?>
                                             </div>
                                             <div class="col-sm-4 address_example">
                                            <p> <b> For Example </b></p>
                                            <p> Jhon Doe</p>
                                             </div>
                                             <div class="clearfix"></div>
												<div class="tabs">
                                              <div class="tab-button-outer">
                                                <ul id="tab-button">
                                                  <li><a href="#tab01">Text</a></li>
                                                  <li><a href="#tab02">Add Picture</a></li>
                                                  <li><a href="#tab03">Add Video</a></li>
                                                </ul>
                                              </div>
                                              <div id="tab01" class="tab-contents">
                                              <?= $form->field($model, 'message')->textarea(['rows' => 2,'cols'=>5,'placeholder'=>'Enter Message'])->label(false); ?>
											  
											  
											  
											  
                                              </div>

                                              <div id="tab02" class="tab-contents">
                                                <?= $form->field($model, 'image_messge')->textarea(['rows' => 2,'cols'=>5,'placeholder'=>'Enter Image Message'])->label(false); ?>
                                              <?= $form->field($model, 'imagename')->widget(FileInput::classname(), [
                                                                                            'options' => ['accept' => 'image/*'],
                                                                                            ])->label(false); ?> 
                                              <span id="image-holder"> </span>
                                            </div>
                                              <div id="tab03" class="tab-contents">
                                              <?= $form->field($model, 'video_message')->textarea(['rows' => 2,'cols'=>5,'placeholder'=>'Enter Video Message'])->label(false); ?>
                                               <?= $form->field($model, 'videoname')->widget(FileInput::classname(), [
                                                                                            'options' => ['accept' => 'video/*'],
                                                                                            ])->label(false); ?>
                                              </div>
  										 </div>
                                           <div class="form-group post_botn">
											<?= Html::submitButton('Post', ['class' => 'btn btn-info']) ?>
                                        </div>
										   <?php ActiveForm::end(); ?>
                                           </div>
                                           <?php } ?>
										<div class="posts-section">
										  <?php   foreach( $dataReader as $row ) {	 ?>
											<div class="post-bar inde_pst_bar">
												<div class="epi-sec">
                                                <div class="container">
 											</div>
                                                  <div class="col-sm-3 tele_out ">
                                                  <div class="zpost_topbar">
													<div class="usy-dt">
														<div class="usy-name">
                                                        <h2>Raising the Discourse </h2>
														</div>
													</div>
												</div></div> 
                                                    <div class="col-sm-6 text-center">
                                                    <img class="res_img" src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram_post.png'; ?>">
                                                    </div><div class="col-sm-3 tele_out">
                                                    <ul class="">
														<li><a href="#" title=""> #456543 </a></li>
														<li><a href="#" title="">  <?php echo date("Y-m-d", strtotime($row['addedon'])); ?></a></li>
													</ul></div>
                                                    <div class="bord_post-bar clearfix"></div>
												</div>
												<div class="job_descp">
                                                <?php if($row['to_address'] != '') {?>
													<h3>Dear <?php echo nl2br($row['to_address']); ?>, </h3>
                                                    <?php } 
													else{ ?>
														<h3>Dear Sir / Madam, </h3>
														<?php }?>
													<p><?php echo nl2br($row['message']); ?>
                                                    <?php echo nl2br($row['image_messge']); ?>
                                                    <?php echo nl2br($row['video_message']); ?><br>
 <a href="#" title="">view more</a></p>
 <?php if($row['imagename'] != ''){ ?>
<p>  <img class="pf_img" src="<?= Yii::$app->request->baseUrl.'/admin/images/postImage/'.$row['imagename']; ?>" height="200px" width="200px"> </p>
  <?php } ?>
  <?php if($row['videoname'] != ''){ 
  $url = Yii::$app->request->baseUrl.'/admin/videos/postVideo/'.$row['videoname'];
  ?>
  <p> <video width="200px" height="200px" controls>
                              <source src= "<?php echo $url;?>" type="video/mp4">
                            </video> </p>
               <?php } ?>              
                                                  <div class="from_sign ">
                                                    <div class="pull-right">
  <p class="">From</p> 
  <?php if(Yii::$app->user->identity->user_pic != ''){?>
                                                      <p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/admin/images/user/'.Yii::$app->user->identity->user_pic; ?>" height="35px" width="35px"></p>
                                                      <?php }
													  else{?>
                                                      <p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/admin/images/user/'.'blank-profile1.png' ?>" height="35px" width="35px"></p>
                                                      <?php } ?>
                                                      <p><?= Yii::$app->user->identity->first_name;?></p>
                                                    </div>
                                                  </div>
												</div>
                                                <?php 
            if(Yii::$app->user->identity->usertype == 'F') {  
           ?>  
												<div class="job-status-bar">
													<ul class="like-com">
                                                    <li><div class="zcontainer">
  <div class="progress">
    <?php
	 $percentageSql = Yii::$app->db->createCommand('SELECT * FROM user INNER JOIN request_delete ON user.id = request_delete.fid WHERE user.id ='.Yii::$app->user->identity->id.' AND pid ='.$row['id'].'')->queryAll();
			 echo Progress::widget([
					'percent' => 45,
					'label' => '45%',
					'options' => ['class' => 'progress-success active progress-striped']
				]);
	?>
</div>
</div>
</li></ul>
               <?= Html::a('Follow', 
        ['profile/follow', 'fid' =>Yii::$app->user->identity->id,'lid'=>$row['id']], 
        ['class' => 'follow btn-outline-rounded bg-info']); 
		?>
                                                   <?= Html::a('<i class="la la-thumbs-down"></i> Request To Delete', 
        ['profile/request-delete', 'fid' =>Yii::$app->user->identity->id,'pid'=>$row['id']], 
        ['class' => 'dlt_btn']); 
		?>
												</div>
                                                <?php } 
												?>
											</div> 
                                            <?php } ?>
                                            </div>
									</div> 
					</div><!-- main-section-data end-->   				
				</div> 
			</div>
		</main>
	</div><!--theme-layout end-->
 
</body>
 
</html>
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
  width: 50%;
  margin: 0;
  padding: 0;
  list-style: none;
}

.tabs .tab-contents .form-group.field-post-message #post-message.form-control{
	
	
	border:none;
   
     -webkit-box-shadow:none; 
     box-shadow: none; 
     -webkit-transition:none; 
    -o-transition:none;
     transition: none; 
}

.tabs .tab-contents .form-group.field-post-image_messge #post-image_messge.form-control{
	
	
	border:none;
   
     -webkit-box-shadow:none; 
     box-shadow: none; 
     -webkit-transition:none; 
    -o-transition:none;
     transition: none; 
}

.tabs .tab-contents .form-group.field-post-video_message #post-video_message.form-control{
	
	
	border:none;
   
     -webkit-box-shadow:none; 
     box-shadow: none; 
     -webkit-transition:none; 
    -o-transition:none;
     transition: none; 
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
.file-preview{
	width: 30%;
}
.fileinput-upload-button {
    display: none;
}
.kv-fileinput-caption.icon-visible {
    display: none;
}
.form-control.kv-fileinput-caption {
    display: none;
}
form#statusFrom {
     width: 100%; 
    margin: 0 auto;
  border: 1px solid #e4e4e4;
    margin-top: 25px;
    margin-bottom: 25px;
	padding-top: 25px;
}
.post_botn{
	text-align:center;
	margin-bottom:15px;
	margin-top:15px;
}
 .mrg_tp{
	 margin-top: 25px;
	 color:#a59e9e;
	 text-decoration:none;
	 background:#fff;
	 margin-left:-45px;
 }
.file-upload-indicator {
    display: none;
}
.chnl_drp .user-account-settingss a{
	padding:10px 15px;
	text-align:center;
	display:block;}
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
  .file-preview{
	width: 30%;
}
}
@media screen (max-width: 480px) {
	.file-preview{
	width: 100%;
}
}
.follow:focus{
 border:none;
 outline:none;}
.follow{
  width:200px;
  height:50px;
}
.follow .msg-follow,
.follow .msg-following,
.follow .msg-unfollow{
  display: none;
}
.follow .msg-follow{
  display: inline;
}
.follow.following .msg-follow{
  display: none;
}
.follow.following .msg-following{
  display: inline;
}
.follow.following:not(.wait):hover .msg-following{
  display: none;
}
.follow.following:not(.wait):hover .msg-unfollow{
  display: inline;
}
</style>