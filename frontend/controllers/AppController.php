<?php
namespace frontend\controllers;
use Yii;
use yii\rest\ActiveController;
use yii\helpers\Url;
use yii\helpers\Html;
use common\components\API;
use common\models\User;
use frontend\models\FollowerDetails;
use frontend\models\RequestDelete;
use frontend\models\NominateLeader;
use frontend\models\Categories;
use frontend\models\Country;
use frontend\models\NominateLeaderDetails;
use frontend\models\Pages;
use admin\models\Post;
use admin\models\LeaderInvite;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\data\ActiveDataProvider;
use yii\filters\AccessControl;

/**
 * PostController implements the CRUD actions for Post model.
 */
class AppController extends ActiveController
{
   	public $modelClass = 'frontend\models\LoginForm';

	public function actionLogin()
    {
		//API::getInputDataArray($data, array('username','password'));		
		if (!API::getInputDataArray($data, array('username','password')))
		{
            return API::echoJsonError('ERROR: Please provide username and password'.$data);
		}
		
		$user = User::findByUsername($data['username']);
		if(!$user || (!$user->validatePassword($data['password'])))
		{
			return API::echoJsonError('ERROR: Username and / or password were Incorrect');
		}
		$userdetails = User::find()->where(['id' =>$user['id']])->All();
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$userdetails);
		return $returnArray;
	}
	public function actionSignup()
	{
		if (!API::getInputDataArray($data, array('name', 'email', 'country', 'password')))
            return;
		$emailCheck = User::find()->where(['email' =>$data['email']])->one();
			
		if (isset($emailCheck))
            return API::echoJsonError ('ERROR: email address was already in the User table', 'The given email address already has an account associated with it.');
		$user = new User();
		$message = array();
		$user->first_name = $data['name'];
		$user->username = $data['email'];
		$user->email = $data['email'];
		$user->usertype = 'F';
		$user->gender = 'M';
		$user->setPassword($data['password']);
        $user->generateAuthKey();
		//$user->save();	
	    if ($user->save()) { 
				$email =  $data['email'];
				$mail =  Yii::$app->mailer->compose()		  
				 ->setFrom('admin@jijigram.com')
				 ->setTo($data['email'])
				 ->setSubject('Registration Confirmation Mail')
				 ->setHtmlBody('
				 Dear Jijigram User,<br><br>
				 Thanks for signing up to jijigram.<br>
				 You can start nominating people now.<br><br>
				 Thank You, <br>
				 The jijigram Team.<br><br>
				 <a href="https://www.jijigram.com/site/login">Please Click Here To Login</a>')
			 	->send();
			   if($mail)
			   {		
					$message = 'success';
			   }
			   else
			   {
					return API::echoJsonError('error','Sorry!could not sent mail');
			   }
		}
		$returnArray['error'] = 0;
		//$returnArray['data1'] = array('message'=>$message);
		$returnArray['data'] = array('user'=>$user);
		return $returnArray;
	}
	/*Register Action end*/
	
	 /*For leader Signup*/
	 public function actionLeadersignup()
	{
		if (!API::getInputDataArray($data, array('name', 'email', 'code', 'country', 'password')))
            return;
		$emailCheck = User::find()->where(['email' =>$data['email']])->one();
			
		if (isset($emailCheck))
            return API::echoJsonError ('ERROR: email address was already in the User table', 'The given email address already has an account associated with it.');
		$user = new User();
		$message = array();
		$leaderinvite = new LeaderInvite();
		$user->first_name = $data['name'];
		$user->username = $data['email'];
		$user->email = $data['email'];
		$code = $data['code'];
		$user->usertype = 'L';
		$user->gender = 'M';
		$user->setPassword($data['password']);
        $user->generateAuthKey();
		$inviteLeader = LeaderInvite::find()->andFilterWhere(['or', ['like', 'code', $code]])->one();
	    $uniqueCode = $inviteLeader['code'];
		if($uniqueCode == $code){
		if($user->save()){
		$mail =  Yii::$app->mailer->compose()		  
					 ->setFrom('admin@jijigram.com')
					 ->setTo($data['email'])
					 ->setSubject('Registration Confirmation Mail')
					 ->setHtmlBody('
				 Dear Jijigram User,<br><br>
				 Thanks for signing up to jijigram.<br>
				 You can start nominating people now.<br><br>
				 Thank You, <br>
				 The jijigram Team.<br><br>
					 <a href="https://www.jijigram.com/site/login">Please Click Here To Login</a>')
					->send();
				   if($mail)
				   {		
						$message = 'success';
				   }
				   else
				   {
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
				   }
		 	}
		 } else { 
		 return API::echoJsonError ('error','Sorry! Wrong Code. Could not Sign Up.Please Give Your Right Code');
		 }
		$returnArray['error'] = 0;
		$returnArray['data'] = array('user'=>$user);
		return $returnArray;
	}
	 
	public function actionGetpost()
	{
		if (!API::getInputDataArray($data, array('userId','channelType')))
            return;
		
		$userData = User::find()->where(['id' =>$data['userId']])->All();
		if(($userData[0]->usertype=='L')&&($data['channelType']=='O'))
		{
			$Posts = Post::find()->where(['userId' =>$data['userId']])->All();
		}
		else
		{
			$getFollowedLeaderSQL = "SELECT * from follower_details WHERE FID = ".$data['userId'];
			$lids = "";
			$getFollowedLeaderROW = Yii::$app->db->createCommand($getFollowedLeaderSQL)->queryAll();
			foreach($getFollowedLeaderROW as $row)
			{
				$lids .= $row['LID'].",";
			}
			$append_post_str = "";
			if($data['channelType']=='M')
			{
				if($lids!='')
				{
					$append_post_str = ' AND FIND_IN_SET(userId,"'.substr($lids,0,-1).'")';
				}
				else
				{
					$append_post_str = ' AND userId = '.$data['userId'];
				}	
			}
			$append_post_str_leader = "";
			if($userData[0]->usertype=='L')
			{
				$append_post_str_leader = ' AND userId <> '.$data['userId'];
			}
			$Posts = Yii::$app->db->createCommand( 'SELECT * FROM post where 1 '.$append_post_str.$append_post_str_leader.' ORDER BY addedon DESC LIMIT 0,50 ')->queryAll();
		}
		
		if (!isset($Posts))
        {
            return API::echoJsonError('ERROR: no records found');
        }
		$post_array = array();
		$i=0;
		$url = "https://jijigram.com";
		foreach($Posts as $Postsrow)
		{
			$leaderId=$Postsrow['userId'];
			$postId = $Postsrow['id'];
			$post_array[$i]['id'] = $postId;
			$post_array[$i]['userId'] = $leaderId;
			$post_array[$i]['message'] = $Postsrow['message'];
			$post_array[$i]['image_messge'] = $Postsrow['image_messge'];
			$post_array[$i]['video_message'] = $Postsrow['video_message'];
			if($Postsrow['imagename']!='')
			{
				$post_array[$i]['imagename'] = $url.'/admin/images/postImage/'.$Postsrow['imagename'];
			}
			else
			{
				$post_array[$i]['imagename'] = "";
			}
			if($Postsrow['videoname']!='')
			{
				$post_array[$i]['videoname'] = $url.'/admin/videos/postVideo/'.$Postsrow['videoname'];
			}
			else
			{
				$post_array[$i]['videoname'] = "";
			}
			
			$post_array[$i]['addedon'] = date("Y-m-d", strtotime($Postsrow['addedon']));
			$post_array[$i]['to_address'] = $Postsrow['to_address'];
			$post_array[$i]['status'] = $Postsrow['status'];
			$post_array[$i]['post_unique_code'] = rand(000001,999999);
			$userdetails = User::find()->where(['id' =>$leaderId])->All();
			$post_array[$i]['from_name'] = $userdetails[0]['first_name'];
			//Total followers for current post leader
			$totalFollower = "";
			$totalfollowers = Yii::$app->db->createCommand( 'SELECT count(FID) as totalfollowers FROM  follower_details WHERE LID ='.$leaderId.'')->queryAll(); 
			 foreach($totalfollowers as $follow){
				$totalFollower = $follow['totalfollowers'];
			}
			//Total request To delete for current post
			$totalreqtodelete = Yii::$app->db->createCommand( 'SELECT count(fid) as totalreqtodelete FROM  request_delete WHERE pid ='.$postId.'')->queryAll(); 
			$totalRequestToDelete = "";
			foreach($totalreqtodelete as $del){
				$totalRequestToDelete = $del['totalreqtodelete'];
			}
			//Total percentage calculation
			$totalpercentage = 0;
			if($totalFollower>0)
			{
				if($totalRequestToDelete>0)
				{
					$totalpercentage = ceil(($totalRequestToDelete/$totalFollower)*100);
				}
			}
			//check if current user followed or not
			$follow = Yii::$app->db->createCommand( 'SELECT * FROM  follower_details WHERE FID ='.$data['userId'].' AND LID ='.$leaderId.'')->queryAll();
			$button_text = "";
			if(!$follow)
			{
				$button_text = "Follow";
			}
			else
			{
				$reqDel = Yii::$app->db->createCommand( 'SELECT * FROM request_delete WHERE fid ='.$data['userId'].' AND pid ='.$postId.'')->queryAll(); 
				if(!$reqDel)
				{
					$button_text = "Request To Delete";
				}
				else
				{
					$button_text = "Request Sent To Delete";
				}
			}
			
			$post_array[$i]['totalpercentage'] = $totalpercentage;
			$post_array[$i]['buttonText'] = $button_text;
			
			$i++;
		}
		
		
 		$returnArray['error'] = 0;
		$returnArray['usertype'] = $userData[0]->usertype;
		$returnArray['totalpost'] = count($post_array);
		$returnArray['data'] = array('post'=>$post_array);
		
		return $returnArray;
		
	}
	
 	// To Follow
	public function actionFollowleader()
	{
		if (!API::getInputDataArray($data, array('userId','leaderId')))
		{
            return API::echoJsonError('ERROR: Please provide details to follow');
		}
			 
		$model1 = new FollowerDetails;	
		//check if already followed
		$checkfollowedROW = Yii::$app->db->createCommand("SELECT count(*) as totdel from  follower_details WHERE FID = '".$data['userId']."' AND LID = '".$data['leaderId']."'")->queryAll();
		$totfollow = 0;
		foreach($checkfollowedROW as $row)
		{
			$totfollow = $row['totdel'];
		}
		if($totfollow==0)
		{
			$model1 -> FID = $data['userId'];
			$model1 -> LID = $data['leaderId'];
			if(!$model1 -> save())
			{
				$message = "Error in saving data";
			}
			else
			{
				$message = "Data Saved";
			}
		}
		else
		{
			$message = "Already Followed";
		}
		
 		$returnArray['error'] = 0;
		$returnArray['data'] = array('message'=>$message);
		
		return $returnArray;
		
	}
	
	// To Request To Delete
	public function actionRequesttodelete()
	{
		if (!API::getInputDataArray($data, array('userId','postId')))
		{
            return API::echoJsonError('ERROR: Please provide details to Requesttodelete');
		}
			 
		$model1 = new RequestDelete();
		//check if already request to delete
		$checkdeletedROW = Yii::$app->db->createCommand("SELECT count(*) as totreqdel from  request_delete WHERE fid = '".$data['userId']."' AND pid = '".$data['postId']."'")->queryAll();
 		
		$totreqdelete = 0;
		foreach($checkdeletedROW as $row)
		{
			$totreqdelete = $row['totreqdel'];
		}
 			
		if($totreqdelete==0)
		{
			$model1 -> fid = $data['userId'];
			$model1 -> pid = $data['postId'];
			if(!$model1 -> save())
			{
				$message = "Error in saving data";
			}
			else
			{
				 
				$message = $this->getSinglepost($data['postId'],$data['userId']);
			}
		}
		else
		{
			$message = "Already Request sent to delete";
		}
		
 		$returnArray['error'] = 0;
		$returnArray['data'] = array('message'=>$message);
		$returnArray['data'] = array('post'=>$message);
		
		return $returnArray;
		
	}
	// To Single Post
	public function getSinglepost($postId,$fid)
	{
 		$singlePost = Yii::$app->db->createCommand( 'SELECT * FROM post WHERE id ='.$postId.' ')->queryAll(); 
		$post_array = array();
		$url = "https://jijigram.com";
		foreach($singlePost as $Postsrow){
  			$leaderId=$Postsrow['userId'];
			$postId = $Postsrow['id'];
			$post_array['id'] = $postId;
			$post_array['userId'] = $leaderId;
			$post_array['message'] = $Postsrow['message'];
			$post_array['image_messge'] = $Postsrow['image_messge'];
			$post_array['video_message'] = $Postsrow['video_message'];
			if($Postsrow['imagename']!='')
			{
				$post_array['imagename'] = $url.'/admin/images/postImage/'.$Postsrow['imagename'];
			}
			else
			{
				$post_array['imagename'] = "";
			}
			if($Postsrow['videoname']!='')
			{
				$post_array['videoname'] = $url.'/admin/videos/postVideo/'.$Postsrow['videoname'];
			}
			else
			{
				$post_array['videoname'] = "";
			}
			
			$post_array['addedon'] = $Postsrow['addedon'];
			$post_array['to_address'] = $Postsrow['to_address'];
			$post_array['status'] = $Postsrow['status'];
			
			
			//Total followers for current post leader
			$totalFollower = "";
			$totalfollowers = Yii::$app->db->createCommand( 'SELECT count(FID) as totalfollowers FROM  follower_details WHERE LID ='.$leaderId.'')->queryAll(); 
			 foreach($totalfollowers as $follow){
				$totalFollower = $follow['totalfollowers'];
			}
			//Total request To delete for current post
			$totalreqtodelete = Yii::$app->db->createCommand( 'SELECT count(fid) as totalreqtodelete FROM  request_delete WHERE pid ='.$postId.'')->queryAll(); 
			$totalRequestToDelete = "";
			foreach($totalreqtodelete as $del){
				$totalRequestToDelete = $del['totalreqtodelete'];
			}
			//Total percentage calculation
			$totalpercentage = 0;
			if($totalFollower>0)
			{
				if($totalRequestToDelete>0)
				{
					$totalpercentage = ceil(($totalRequestToDelete/$totalFollower)*100);
				}
			}
			//check if current user followed or not
			$follow = Yii::$app->db->createCommand( 'SELECT * FROM  follower_details WHERE FID ='.$fid.' AND LID ='.$leaderId.'')->queryAll();
			$button_text = "";
			if(!$follow)
			{
				$button_text = "Follow";
			}
			else
			{
				$reqDel = Yii::$app->db->createCommand( 'SELECT * FROM request_delete WHERE fid ='.$fid.' AND pid ='.$postId.'')->queryAll(); 
				if(!$reqDel)
				{
					$button_text = "Request To Delete";
				}
				else
				{
					$button_text = "Request Sent To Delete";
				}
			}
			
			$post_array['totalpercentage'] = $totalpercentage;
			$post_array['buttonText'] = $button_text;
		}
		return $post_array;
		
	}
	
	//for leader post
	public function actionLeaderpost()
	{
		//return API::echoJsonError('ERROR: Please provide details to post-->'.$_REQUEST);
		if (!API::getInputDataArray($data, array('userId', 'message', 'image_messge', 'video_message', 'to_address')))
		{
            return API::echoJsonError('ERROR: Please provide details to post->'.$data.var_dump($data));
		}
		 
 		
		$imagename = "";
		if(isset($_FILES['imagename']))
		{
			$imagename = $_FILES['imagename']['name'];
			
			$incoming_report_path = Yii::getAlias('@webroot/admin/images/postImage/'.$imagename);
            if (!move_uploaded_file($_FILES['imagename']['tmp_name'], $incoming_report_path))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['imagename'], true));
            }
        }
		$videoname = "";
		if(isset($_FILES['videoname']))
		{
			$videoname = $_FILES['videoname']['name'];
			
			$incoming_report_path = Yii::getAlias('@webroot/admin/videos/postVideo/'.$videoname);
            if (!move_uploaded_file($_FILES['videoname']['tmp_name'], $incoming_report_path))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['videoname'], true));
            }
        }
 		 $postobj = new Post();
		 if($videoname!=''){$postobj->videoname = $videoname;}
		 if($imagename!=''){$postobj->imagename = $imagename;}
		$postobj->userId = $data['userId'];
		if(isset($data['message'])){$postobj->message = $data['message'];}
		if(isset($data['image_messge'])){$postobj->image_messge = $data['image_messge'];}
		if(isset($data['video_message'])){$postobj->video_message = $data['video_message'];}
		if(isset($data['to_address'])){$postobj->to_address = $data['to_address'];}
		$postobj -> addedon = date('Y-m-d H:i:s');
		$postobj -> status = 'Y';
		$postobj -> totalvotetodelete = 1;
 		//$post->save();
		if(!$postobj->save())
 	 		{
   		$returnArray['msg'] = $postobj->validate();
  		}
		 	
		$returnArray['error'] = 0;
		$returnArray['data'] = array('post'=>$postobj);
		return $returnArray;
	}	
	
	//Nominated
	/*
	{"data":{"leader_name":"sumana",
	"country":"4",
	"category":"5",
	"userId" :  "122"
	}}
	*/
	public function actionNominate()
	{
		if (!API::getInputDataArray($data, array('leader_name', 'country', 'category', 'userId')))
		{
            return API::echoJsonError('ERROR: Please provide details to nominate');
		}
 		
		$nominateLeader = new NominateLeader();
		$NominateLeaderDetails = new NominateLeaderDetails();
		$leader_name = $data['leader_name']; 
			$sql = NominateLeader ::find()->where(['leader_name' => $leader_name])->one();
			//$sql = Yii::$app->db->createCommand( 'SELECT * FROM nominated_leader where leader_name = "Narendara Modi"')->queryAll();
			$nominated_leader_id  = $sql['id'];
			
			if(empty($sql)){
				$sql = NominateLeader ::find()->where(['leader_name' => $leader_name])->one();
				$nominated_leader_id  = $sql['id'];
				$nominateLeader->leader_name = $data['leader_name'];
				$nominateLeader->country = $data['country'];
				$nominateLeader->category = $data['category'];
				$nominateLeader->total_nominated = 1;
				$nominateLeader->save();
				
				$NominateLeaderDetails -> FID = $data['userId'];
				$NominateLeaderDetails -> nominated_leader_id = $nominateLeader->id;
				$NominateLeaderDetails -> addedon = date('Ymd');
				$NominateLeaderDetails -> save();
				Yii::$app->session->setFlash('success', "Thank you for Nominating a Leader");
			}
		
			else
			{				
				$nominated_leader_id  = $sql['id'];
				$FID  = $data['userId'];
				$queryDetails = NominateLeaderDetails ::find()
				->where(['nominated_leader_id' => $nominated_leader_id, 'FID' => $FID])->all();
		   
			   if(!empty($queryDetails))
			   {
			   		Yii::$app->session->setFlash('error', "Sorry! You Have Already Nominated As a Leader This Person");	

			   }
			  else
			  {
					$NominateLeaderDetails -> FID = $data['userId'];
					$NominateLeaderDetails -> nominated_leader_id = $nominated_leader_id;
					$NominateLeaderDetails -> addedon = date('Ymd');
					$NominateLeaderDetails -> save();
					Yii::$app->session->setFlash('success', "Thank you for Nominating a Leader");
			  }		
			}
  			
		$returnArray['error'] = 0;
		$returnArray['data'] = array('nominateLeader'=>$nominateLeader);
		$returnArray['data_details'] = array('NominateLeaderDetails'=>$NominateLeaderDetails);
 		return $returnArray;
	}
	//Category
	/*
	Url - http://jijigram.com/app/getcategory
	*/
	public function actionGetcategory()
	{
		$category = Categories::find()->orderBy([
		'name'=>SORT_ASC
		])->all();
  			
		$returnArray['error'] = 0;
		$returnArray['data'] = array('category'=>$category);
 		return $returnArray;
	}
	//Country
	/*
	Url - http://jijigram.com/app/getcountry
	*/
	public function actionGetcountry()
	{
		$country = Country::find()->orderBy([
		'name'=>SORT_ASC
		])->all();
  			
		$returnArray['error'] = 0;
		$returnArray['data'] = array('country'=>$country);
 		return $returnArray;
	}
	//Edit Profile
	/*
	{"data":{"id": 155,
	"username":"gulshan123444@yopmail.com",
	"name":"Gulshan",
	"gender":"M",
	"email":"gulshan123444@yopmail.com",
	"phone":"",
	"dob":"",
	"address1":"",
	"city":"",
	"zip":""
	}}
	*/
	public function actionProfileEdit()
	{
		
		if (!API::getInputDataArray($data, array('id', 'name', 'gender', 'email', 'phone', 'dob', 'address1', 'city', 'zip')))
		{
            return API::echoJsonError('ERROR: Please provide details to profile');
		}
			
		$profile = User::find()->where(['id' => $data['id']])->one();
		$imagename = $profile->user_pic;
		if(isset($_FILES['imagename']))
		{
			$imagename = $_FILES['imagename']['name'];
			
			$incoming_report_path = Yii::getAlias('@webroot/admin/images/user/'.$imagename);
            if (!move_uploaded_file($_FILES['imagename']['tmp_name'], $incoming_report_path))
            {
                return API::echoJsonError($errorMsg, 'There was an error recieving the assessmentzip POST param file. DEBUG: '.var_export($_FILES['imagename'], true));
            }
        }
		$profile->first_name = $data['name'];
		$profile->gender = $data['gender'];
		$profile->email = $data['email'];
		$profile->phone = $data['phone'];
		$profile->user_pic = $imagename;
		$profile->dob = $data['dob'];
        $profile->address1 = $data['address1']; 
		$profile->city = $data['city'];
		$profile->zip = $data['zip'];   
  		$profile->save();
				
		$returnArray['error'] = 0;
		$returnArray['data'] = array('profile'=>$profile);
 		return $returnArray;
	}
	//Change Password
	/*
	{"data":{"username":"kussoftware010@gmail.com","password":"deep123#","newpass":"deep12345#"}}
	*/
	public function actionChangepassword()
	{
		if (!API::getInputDataArray($data, array('username', 'password', 'newpass')))
		{
            return API::echoJsonError('ERROR: Please Provide Details for Change Password');
		}		 
        $modeluser = User::find()->where(['username'=>$data['username']])->one();
		if(!$modeluser)
		{
			return API::echoJsonError('ERROR: Sorry!! This Username Does not Exist in the Database');
		}
		$password = $modeluser->password_hash;  //returns current password as stored in the dbase
		
        if( !Yii::$app->security->validatePassword($data['password'],$password))
		{
			return API::echoJsonError('ERROR: Sorry!! Old Password Does not Exist in the Database');
		}
		else
		{
			$modeluser->password_hash = Yii::$app->security->generatePasswordHash($data['newpass']);
			$modeluser->save();  
			$returnArray['data'] = array('modeluser'=>$modeluser);						  
		}	
   		$returnArray['error'] = 0;	
 		return $returnArray;   
	}
	
	public function actionFollowerlisting()
	{
		if (!API::getInputDataArray($data, array('userId')))
            return;
 		
		$totalFollow = Yii::$app->db->createCommand( 'SELECT u.user_pic, u.first_name, fw.LID, fw.FID FROM follower_details fw INNER JOIN user u ON fw.FID = u.id WHERE fw.LID ='.$data['userId'].' ')->queryAll();
 		
		$returnArray['error'] = 0;
 		$returnArray['data'] = array('totalFollow'=>$totalFollow);
 		return $returnArray;
		
	}
	//Nominate leader name search
	/*
	{"data":{"username":"kussoftware010@gmail.com","password":"deep123#","newpass":"deep12345#"}}
	*/
	 public function actionNominateleadersearch()
	 {
	  if (!API::getInputDataArray($data, array('countryId', 'categoryId', 'nominate_leader_name')))
	  {
			return API::echoJsonError('ERROR: Please Provide Details for Nominate Leader Search');
	  }
	   
	  $nominate_leader_search = Yii::$app->db->createCommand("SELECT DISTINCT leader_name, count(total_nominated) as tot,leader_name FROM nominated_leader WHERE category ='".$data['categoryId']."' AND country ='".$data['countryId']."' AND leader_name LIKE '%".$data['nominate_leader_name']."%' OR soundex(leader_name)= soundex('".$data['nominate_leader_name']."')")->queryAll();
	     
	  $returnArray['error'] = 0;
	   $returnArray['data'] = array('nominate_leader_search'=>$nominate_leader_search);
	   return $returnArray;
	  
	 }
	 //Pages
	/*
	{"data":{"pageId":"2"}}
	*/
	 public function actionPages()
	 {
	  if (!API::getInputDataArray($data, array('pageId')))
	  {
			return API::echoJsonError('ERROR: Please Provide Details for Page Information');
	  }	   
	  $pages = Pages::find()->select(['title','description'])->where(['id'=>$data['pageId']])->one();	     
	  $returnArray['error'] = 0;
	   $returnArray['data'] = array('pages'=> $pages);
	   return $returnArray;
	  
	 }
	 //Pages
	/*
	url - http://jijigram.com/app/contact
	{"data":{"name":"baby",
	"email":"kussoftware0577@gmail.com",
	"mobile":"4567890456",
	"message":"request my request"
	}}
	*/
	 public function actionContact()
	 {
		if (!API::getInputDataArray($data, array('name', 'email', 'mobile','message')))
		 {
			return API::echoJsonError('ERROR: Please Provide Details for contact Information');
	 	 }	
		$contact = array();
		$contact['name'] = $data['name'];
		$contact['email'] = $data['email'];
		$contact['mobile'] = $data['mobile'];
		$contact['message'] = $data['message'];
		$email =  $data['email'];
			$mail =  Yii::$app->mailer->compose()		  
			->setFrom('admin@jijigram.com')
			//->setFrom('kussoftware05.com')
			->setTo('birja@kusmail.com')
			//->setTo('kussoftware@gmail.com')
			->setSubject('Contact Us - new enquiry came')
			->setHtmlBody('
			 <b>Dear Jijigram Admin,<br>
			 New Submitted Contact Us User Information is below here - </b><br>
			  Details are here - <br>
			 <b>Name </b>- '.$data['name'].' <br>
			 <b>Email Id </b>- '.$data['email'].' <br>
			 <b>Mobile_No </b>- '.$data['mobile'].' <br>
			 <b>comment </b>- '.$data['message'].' <br>
			 <br>')
			->send();
			   if($mail)
			   {		
					$message = 'success';
			   }
			   else
			   {
					return API::echoJsonError('error','Sorry!could not sent mail');
			   }
   		$returnArray['error'] = 0;
		$returnArray['data'] = array('contact'=> $contact);
		return $returnArray;
	}
}
