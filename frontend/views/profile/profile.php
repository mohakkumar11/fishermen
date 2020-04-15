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


function getpagetype()
{
	$currentPage=$_SERVER['REQUEST_URI'];
	if (strpos($currentPage, 'my-channels') !== false) 
	{
    	return 'mychannel';
	}
	elseif (strpos($currentPage, 'public-channels') !== false) 
	{
    	return 'publicchannel';
	}
	elseif (strpos($currentPage, 'my-post') !== false) 
	{
    	return 'mypost';
	}
}
$pagetype = getpagetype();
?>

	<div class="container">
    <section class="cover-sec">   
    <?php if(Yii::$app->user->identity->usertype == 'L') {  ?>    
			<a href="<?= Yii::$app->urlManager->createUrl(['profile/my-post']);?>" title=""><i class="fa fa-camera"></i>POST</a>
     <?php } ?>
		</section>
<div class="posts-section prf_margin">
 <?php 	?>
<div class="channels">
<ul class="cnt_channels">
  <li class="<?php if($pagetype=='publicchannel'){echo 'active';}?>"><a href="<?= Yii::$app->urlManager->createUrl(['profile/public-channels']);?>">Public Channel</a></li>  
  <li class="<?php if($pagetype=='mychannel'){echo 'active';}?>"><a href="<?= Yii::$app->urlManager->createUrl(['profile/my-channels']);?>">My Channel</a></li>
  <?php if(Yii::$app->user->identity->usertype == 'L') {  ?>
  <li class="<?php if($pagetype=='mypost'){echo 'active';}?>"><a href="<?= Yii::$app->urlManager->createUrl(['profile/my-post']);?>">My Post</a></li>
  <?php } ?>
  </ul>
                                 </div>
                                 <?php
                                 if(empty($dataReader))
								{
									?>
									<!--<div style="color: #F00; font-size:20px;">
									<?php
									echo "Sorry! No Posts are Found.";?>
									</div>-->
                                    <div style="font-size:15px;padding-top: 34px;">
                                    <div class="post-bar">
										 
												<div class="epi-sec">
                                                <div class="container">
 											</div>
                                                  <div class="col-sm-3 tele_out ">
                                                  <div class="zpost_topbar">
													<div class="usy-dt">
														<div class="usy-name">
                                                        <h2>Raising the Discourse</h2>
														</div>
													</div>
												</div></div> <div class="col-sm-6 text-center"><img class="res_img" src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram_post.png'; ?>">
                                                    </div><div class="col-sm-3 tele_out">
                                                    <ul class="">
														<li><a href="#" title="">
														<!--<i class=" fa fa-pencil-square-o"></i>-->  #<?php echo rand(111111,999999);?> </a></li>
														<li><a href="#" title=""> <?php echo date("Y-m-d"); ?></a></li>
													</ul></div>
                                                    <div class="bord_post-bar clearfix"></div>
												</div>
												<div class="job_descp">
                                             
													<h3>Dear Jijigram User, </h3>
                                                   
													<p> Thank you for joining Jijigram, a social community that prides itself on raising the discourse at an important time in the life of the Internet. As promised, you control the conversation, you determine who will Post on Jijigram and you have the ability to have your voice heard by deleting Posts.

We invite you to gather 1000 nominations and become a Leader on Jijigram. We remind Leaders that they must use care when they Post as they have no delete privileges. Once a Post is up, the only way it can be removed is by Followers and by the Jijigram Team for Code of Conduct violations.

Thank you in advance for sharing the Jijigram link with all of your friends and family. </p>

<p>Wishing you the best,</p><br>
            
                                                  <div class="from_sign">
                                                    <div class="pull-right">																																												
													  <p class="">From</p> 
											<p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/images/'.'static_profile.png'; ?>" ></p>
                                              <p>The Jijigram Team</p>
                                                    </div>
                                                  </div>
												</div>
												
                                          
										</div>
									</div>
									<?php	
								}
								else
								{
								  
 										   foreach( $dataReader as $row ) {
											$pid=nl2br($row['id']);
											/*$totalreqtodelete = Yii::$app->db->createCommand( 'SELECT count(fid) as totalreqtodelete FROM  request_delete WHERE pid ='.$pid.'')->queryAll(); 
											$reqDel = "";
											foreach($totalreqtodelete as $del){
												$reqDel = $del['totalreqtodelete'];
											}*/
											 ?>	
									 
											<?php 
											$lid=$row['userId'];
											$reqfollow = "";
											/*$totalfollowers = Yii::$app->db->createCommand( 'SELECT count(FID) as totalfollowers FROM  follower_details WHERE LID ='.$lid.'')->queryAll(); 
											 foreach($totalfollowers as $follow){
												$reqfollow = $follow['totalfollowers'];
											}	*/
											 ?>			 
											<?php 
											$totalpercentage = 0;
											if($reqfollow>0)
											{
												if($reqDel>0)
												{
													$totalpercentage = ceil(($reqDel/$reqfollow)*100);
												}
											}
											//$totalpercentage= ($reqDel*$reqfollow)/100; ?>
											<?php //$totalpercentage= 51; ?>
										   <?php if($totalpercentage> 51)
											   {?>
												<div class="post-bar box-color">
											 <?php } else { ?>
                                             <div style="font-size:15px;padding-top: 34px;">
                                    <div class="post-bar">
												<div class="epi-sec">
                                                <div class="container">
 											</div>
                                                  <div class="col-sm-3 tele_out ">
                                                  <div class="zpost_topbar">
													<div class="usy-dt">
														<div class="usy-name">
                                                        <h2>Raising the Discourse</h2>
														</div>
													</div>
												</div></div> <div class="col-sm-6 text-center"><img class="res_img" src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram_post.png'; ?>">
                                                    </div><div class="col-sm-3 tele_out">
                                                    <ul class="">
														<li><a href="#" title="">
														<!--<i class=" fa fa-pencil-square-o"></i>-->  #<?php echo rand(111111,999999);?> </a></li>
														<li><a href="#" title=""> <?php echo date("Y-m-d"); ?></a></li>
													</ul></div>
                                                    <div class="bord_post-bar clearfix"></div>
												</div>
												<div class="job_descp">
                                             
													<h3>Dear Jijigram User, </h3>
                                                   
													<p> Thank you for joining Jijigram, a social community that prides itself on raising the discourse at an important time in the life of the Internet. As promised, you control the conversation, you determine who will Post on Jijigram and you have the ability to have your voice heard by deleting Posts.

We invite you to gather 1000 nominations and become a Leader on Jijigram. We remind Leaders that they must use care when they Post as they have no delete privileges. Once a Post is up, the only way it can be removed is by Followers and by the Jijigram Team for Code of Conduct violations.

Thank you in advance for sharing the Jijigram link with all of your friends and family. </p>

<p>Wishing you the best,</p><br>
                                                           <div class="from_sign">
                                                    <div class="pull-right">																																												
													  <p class="">From</p> 
											<p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/images/'.'static_profile.png'; ?>" ></p>
                                              <p>The Jijigram Team</p>
                                                    </div>
                                                  </div>
												</div>
												
                                          
										</div>
									</div>
 											 <div class="post-bar">
										  <?php } ?>
												<div class="epi-sec">
                                                <div class="container">
 											</div>
                                                  <div class="col-sm-3 tele_out ">
                                                  <div class="zpost_topbar">
													<div class="usy-dt">
														<div class="usy-name">
                                                        <h2>Raising the Discourse <?php //echo $reqDel."->".$reqfollow."->".$totalpercentage;?></h2>
														</div>
													</div>
												</div></div> <div class="col-sm-6 text-center"><img class="res_img" src="<?= Yii::$app->request->baseUrl.'/images/'.'rose-telegram_post.png'; ?>">
                                                    </div><div class="col-sm-3 tele_out">
                                                    <ul class="">
														<li><a href="#" title="">
														<!--<i class=" fa fa-pencil-square-o"></i>-->  #<?php echo rand(111111,999999);?> </a></li>
														<li><a href="#" title=""> <?php echo date("Y-m-d", strtotime($row['addedon'])); ?></a></li>
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
  <img class="pf_img" src="<?= Yii::$app->request->baseUrl.'/admin/images/postImage/'.$row['imagename']; ?>" height="200px" width="200px">
  <?php } ?>
  <?php if($row['videoname'] != ''){ 
  $url = Yii::$app->request->baseUrl.'/admin/videos/postVideo/'.$row['videoname'];
  ?>
  <video width="200px" height="200px" controls>
                              <source src= "<?php echo $url;?>" type="video/mp4">
                            </video>
               <?php } ?>              
                                                  <div class="from_sign ">
                                                    <div class="pull-right">
													<?php $leaderId =$row['userId']; ?>
													<?php $leaderPost = Yii::$app->db->createCommand( 'SELECT * FROM  user WHERE id ='.$leaderId.'')->queryAll();
													foreach($leaderPost as $led){
														
														$led=$led['first_name'];
													}
													
													?>
													
													
													  <p class="">From</p> 
													  <?php if(Yii::$app->user->identity->user_pic != ''){?>
                                                      <p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/admin/images/user/'.Yii::$app->user->identity->user_pic; ?>" height="50px" width="50px"></p>
                                                      <?php }
													  else{?>
                                                      <p> <img class="img-circle" src="<?= Yii::$app->request->baseUrl.'/admin/images/user/'.'blank-profile1.png' ?>" height="50px" width="50px"></p>
                                                      <?php } ?>
                                                      <p><?php echo $led;?></p>
                                                    </div>
                                                  </div>
												</div>
												<div class="job-status-bar">
						  <ul class="like-com">
							  <li>
								<div class="zcontainer">
									<div class="progress">
										<?php
										echo Progress::widget([
											'percent' => $totalpercentage,
											'label' => $totalpercentage.'%',
											'options' => ['class' => 'progress-success active progress-striped']
										]);
										?>
										 
									</div>
							</li>
						</ul>
		
		 
			<?php
			// Button code starts here
			
			$leaderId=$row['userId']; //Leader ID which we get from post table
			
			//Check if logged in user is follower of above leader
			
			
			?>

		 
		
											</div>
											</div>
                                             <?php } 
											echo LinkPager::widget([
    'pagination'=>$dataProviders->pagination,
]);
										
                                        }
											
											 ?>
								 
										
                                           <div class="process-comm">
												<div class="spinner">
													<div class="bounce1"></div>
													<div class="bounce2"></div>
													<div class="bounce3"></div>
												</div>
											</div>
										</div>
</div>
</body>
</html>
<style>
.cnt_channels li{display: inline-block;}
.cnt_channels li.active a {
    color: #fff;
	padding:10px 15px;
	background:#732699;
}

.box-color{
	 
	background: #888;
}
.alert-success{text-align:center;}

.cnt_channels li a{
	    color: #732699;
}
.progress-bar {
    float: left;
    width: 0;
    height: 100%;
    font-size: 12px;
    line-height: 20px;
    color: #fff;
    text-align: center;
    background-color: #732699;
}

.box-color .job_descp{
	 text-decoration-line: overline underline;
    text-decoration-style: wavy;
	text-decoration:line-through;
	text-decoration: line-through;
}
.box-color .job_descp a{
	display:none;
}
.box-color .job_descp img{
	display:none;
}


.box-color .job_descp video{
	display:none;
}


</style>