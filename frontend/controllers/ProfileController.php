<?php
namespace frontend\controllers;
use Yii;
use yii\imagine\Image;
use yii\imagine;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use admin\models\User; 
use admin\models\Post;
use yii\web\UploadedFile;
use frontend\models\RequestDelete;
use frontend\models\FollowerDetails;
use frontend\models\Nominate;
use frontend\models\NominateLeader;
use frontend\models\NominateLeaderDetails;
use frontend\models\InviteFriends;
use yii\db\ActiveQuery;
use yii\db\Query;
use yii\data\SqlDataProvider;
use yii\grid\GridView;
use yii\data\Pagination;
use yii\data\ActiveDataProvider;
class ProfileController extends Controller
{
	/**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                //'only' => ['index'],
                'rules' => [
                    [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					 [
                        'actions' => ['public-channels'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['public-channels'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['my-channels', 'my-post'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['my-channels', 'my-post'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['update'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['request-delete'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['request-delete'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['listings'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
					[
                        'actions' => ['listings'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['nominate'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
     				[
                        'actions' => ['nominate'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['category', 'search', 'follow', 'find', 'invite-friends'],
                        'allow' => true,
                        'roles' => ['*'],
                    ],
     				[
                        'actions' => ['category', 'search', 'follow', 'find', 'invite-friends'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],					
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }
    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    /**
     * Displays homepage.
     *
     * @return mixed
     */
    public function actionIndex()
    { 
		if(Yii::$app->user->identity->usertype == 'L') {
		 $model = new Post();
		$id = $model->userId = Yii::$app->user->identity->id;
		
		 $model -> addedon = date('Y-m-d H:i:s');
	   $dataProviders = new ActiveDataProvider([
				'query' => Post::find()
				  ->where(['userId' => $id]),
				'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
				 'pagination' => [
					'pageSize' => 10,
				],
			]);   
	 $dataProviders->getCount();
	 $dataReader = $dataProviders->getModels();
   $request = \Yii::$app->getRequest();
    if ($request->isPost && $model->load($request->post()) && $model->validate()) 
	{
 			$image= UploadedFile::getInstance($model,'imagename');
 			$video = $model->videoname = UploadedFile::getInstance($model, 'videoname');
 			if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
			{
   				//$originFile = $image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/').'/'.$image->name);	
				//$thumbnFile = $image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/thumImage').'/'.'thumb_'.$image->name);
				$image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/').'/'.$image->name);	
				// generate a thumbnail image
				/*Image::thumbnail('@webroot/admin/images/postImage/wallpaper2you.jpg', 120, 120)->save(Yii::getAlias('@webroot/admin/images/postImage/thumImage/thumb_wallpaper2you.jpg.jpg'), ['quality' => 50]);	*/
			    $model->imagename=$image->name;
			}
			if(isset($video -> tempName) && in_array($video->extension, array('mp4')))
			{
				$video->saveAs(Yii::getAlias('@webroot/admin/videos/postVideo/').'/'.$video->name);	
			    $model-> videoname = $video-> name;
			}
			 $model->userId=Yii::$app->user->id;
 			if($model->save())
			{
				$totalFollow = Yii::$app->db->createCommand( 'SELECT u.email, u.first_name, fw.LID, fw.FID FROM follower_details fw INNER JOIN user u ON fw.FID = u.id WHERE fw.LID ='.$id.' ')->queryAll();
		foreach($totalFollow as $res)
		{
			$followerEmailid = $res['email'];		
					$mail =  Yii::$app->mailer->compose()		  
					 ->setFrom('admin@jijigram.com')
					 //->setTo($emailInfo['LeaderInvite']['email'])
					 ->setTo($followerEmailid)
					 ->setSubject('Status Notification')
					 ->setHtmlBody('
					 <b>Hi Dear, Your leader has Posted a New Status. Please check on Your site.</b><br><br>
					  <a href="https://www.jijigram.com/site/login">Please Click Here To Login</a>')
					->send();
				   if($mail)
				   {		
						Yii::$app->session->setFlash('success','Mail Sent Successfully.');
				   }
				   else
				   {
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
				   }
		}
 				Yii::$app->session->setFlash('success', "Status Uploaded Successfully");		
			 return $this->redirect(['index']);	
 				 return $result;
			}
			else
			{
				echo 'Failed';
			} 
 			Yii::$app->session->setFlash('success', "Post Created Successfully");		
			  return $this->render('index', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);				
        } else {
            return $this->render('index', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);
        }
		}
		else{
			return $this->redirect(['profile/my-channels']);
			}
    }
	public function actionPublicChannels()
    {
		 $model = new Post();
		  
			$id = Yii::$app->user->identity->id;
			$dataProviders = new ActiveDataProvider([
			'query' => Post::find()
			  ->where(['NOT IN', 'userId', $id])
			->orderBy(['id' => 'DESC']),
			'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
			 'pagination' => [
				'pageSize' => 10,
			],
		]);   
	 $dataProviders->getCount();
	 $dataReader = $dataProviders->getModels();
		return $this->render('profile', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);
	}
	public function actionMyChannels()
    {
		$model = new Post();	
		$dataProviders = new ActiveDataProvider([
    'query' => Post::find(),
	'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
     'pagination' => [
        'pageSize' => 10,
    ],
]);   
 $dataProviders->getCount();
 $dataReader = $dataProviders->getModels();
// echo '<pre>';print_r($dataReader);
		return $this->render('profile', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);
	}
	
	public function actionMyPost()
    { 
		if(Yii::$app->user->identity->usertype == 'L') {
		 $model = new Post();
		$id = $model->userId = Yii::$app->user->identity->id;
		
		 $model -> addedon = date('Y-m-d H:i:s');
	   $dataProviders = new ActiveDataProvider([
				'query' => Post::find()
				  ->where(['userId' => $id]),
				'sort'=> ['defaultOrder' => ['id'=>SORT_DESC]],
				 'pagination' => [
					'pageSize' => 10,
				],
			]);   
	 $dataProviders->getCount();
	 $dataReader = $dataProviders->getModels();
   $request = \Yii::$app->getRequest();
    if ($request->isPost && $model->load($request->post()) && $model->validate()) 
	{
 			$image= UploadedFile::getInstance($model,'imagename');
 			$video = $model->videoname = UploadedFile::getInstance($model, 'videoname');
 			if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
			{
   				//$originFile = $image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/').'/'.$image->name);	
				//$thumbnFile = $image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/thumImage').'/'.'thumb_'.$image->name);
				$image->saveAs(Yii::getAlias('@webroot/admin/images/postImage/').'/'.$image->name);	
				// generate a thumbnail image
				/*Image::thumbnail('@webroot/admin/images/postImage/wallpaper2you.jpg', 120, 120)->save(Yii::getAlias('@webroot/admin/images/postImage/thumImage/thumb_wallpaper2you.jpg.jpg'), ['quality' => 50]);	*/
			    $model->imagename=$image->name;
			}
			if(isset($video -> tempName) && in_array($video->extension, array('mp4')))
			{
				$video->saveAs(Yii::getAlias('@webroot/admin/videos/postVideo/').'/'.$video->name);	
			    $model-> videoname = $video-> name;
			}
			 $model->userId=Yii::$app->user->id;
 			if($model->save())
			{
				$totalFollow = Yii::$app->db->createCommand( 'SELECT u.email, u.first_name, fw.LID, fw.FID FROM follower_details fw INNER JOIN user u ON fw.FID = u.id WHERE fw.LID ='.$id.' ')->queryAll();
		foreach($totalFollow as $res)
		{
			$followerEmailid = $res['email'];		
					$mail =  Yii::$app->mailer->compose()		  
					 ->setFrom('admin@jijigram.com')
					 //->setTo($emailInfo['LeaderInvite']['email'])
					 ->setTo($followerEmailid)
					 ->setSubject('Status Notification')
					 ->setHtmlBody('
					 <b>Hi Dear, Your leader has Posted a New Status. Please check on Your site.</b><br><br>
					  <a href="https://www.jijigram.com/site/login">Please Click Here To Login</a>')
					->send();
				   if($mail)
				   {		
						Yii::$app->session->setFlash('success','Mail Sent Successfully.');
				   }
				   else
				   {
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
				   }
		}
 				Yii::$app->session->setFlash('success', "Status Uploaded Successfully");		
			 return $this->redirect(['my-post']);	
 				 return $result;
			}
			else
			{
				echo 'Failed';
			} 
 			Yii::$app->session->setFlash('success', "Post Created Successfully");		
			  return $this->render('index', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);				
        } else {
            return $this->render('index', [
                'model' => $model,
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
            ]);
        }
		}
		else{
			return $this->redirect(['profile/my-channels']);
			}
    }
	 /**
     * Updates an existing User model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = $this->findModel($id);
		$filename = $model->user_pic;
		$model->user_pic = $filename;
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			$image = UploadedFile::getInstance($model,'user_pic');
			if(isset($image))
			{
				if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
				{
					$image->saveAs(Yii::getAlias('@webroot/admin/images/user/').$image->name);	
					$model->user_pic = $image->name;
				}
			}
			else
			{
					$model->user_pic = $filename;
			}
			$model->save();
			Yii::$app->session->setFlash('success', "User Updated Successfully");	
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('update', [
            'model' => $model,
        ]);
    }
	protected function findModel($id)
    {
        if (($model = user::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
	public function actionRequestDelete($fid, $pid)
    {
		$model1 = new RequestDelete();
		$dataReader = Yii::$app->db->createCommand( 'SELECT * FROM post where userId ='.Yii::$app->user->identity->id.' ORDER BY id DESC ')->queryAll();
		$model = new Post();
		//check if already deleted
			$checkdeletedROW = Yii::$app->db->createCommand("SELECT count(*) as totreqdel from   request_delete WHERE fid = '".$fid."' AND pid = '".$pid."'")->queryAll();
			$totreqdelete = 0;
			foreach($checkdeletedROW as $row)
			{
				$totreqdelete = $row['totreqdel'];
			}
		   if($totreqdelete==0)
			{
			$model1 -> fid = $fid;
			$model1 -> pid = $pid;
			$model1 -> save();
			}
			$totalDel = Yii::$app->db->createCommand( 'SELECT COUNT(id) as total FROM request_delete WHERE fid ='.Yii::$app->user->identity->id.' AND pid ='.$pid.'')->queryAll();

 			foreach( $totalDel as $del ) {
				$reqDel = $del['total'];
			$totalDel = Yii::$app->db->createCommand( 'UPDATE post SET totalvotetodelete = '.$reqDel.' WHERE userId ='.Yii::$app->user->identity->id.' AND id ='.$pid.'')->query(); 
	}
	Yii::$app->session->setFlash('success', "Request to Delete Selected");
		return $this->redirect(['profile/my-channels']);
		/*return $this->render('index', [
            'model' => $model,
				'dataReader' => $dataReader,
				'totalDel' => $totalDel 
        ]);*/
	}
	public function actionListings($id)
    {
		$query = new Query;
		$query	->select(['user.*', 'follower_details.*'])  
			->from('follower_details')
			->select(['follower_details.LID', 'follower_details.FID', 'user.user_pic', 'user.first_name'])
			->innerjoin('user', 'follower_details.FID = user.id')	
			->where(['follower_details.LID' => $id])
			-> all();
	$dataProviders = new ActiveDataProvider([
		'query' => $query,
		 'pagination' => [
			'pageSize' => 2,
		],
	]);   
 $dataProviders->getCount();
 $dataReader = $dataProviders->getModels();
	return $this->render('follow', [
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
        ]);
	}
	public function actionNominate($id)
    {
		$data = Yii::$app->request->post();
		$model = new User;
		$model1 = new NominateLeader();
		$model2 = new NominateLeaderDetails();
		if($model1->load(Yii::$app->request->post()))
		{
			$leader_name = $data['NominateLeader']['leader_name']; 
			$sql = NominateLeader ::find()->where(['leader_name' => $leader_name])->one();
			//$sql = Yii::$app->db->createCommand( 'SELECT * FROM nominated_leader where leader_name = "Narendara Modi"')->queryAll();
			$nominated_leader_id  = $sql['id'];

			if(empty($sql)){
			$countryId = $data['User']['countryId'];
			$leader_name = $data['NominateLeader']['leader_name']; 
			$category = $data['NominateLeader']['category']; 
			$model1 = new NominateLeader();
			$model1 -> leader_name = $leader_name;
			$model1 -> category = $category;
			$model1 -> country = $countryId;
			$model1 -> total_nominated = 1;			
			$model1 -> save();
			
			$model2 -> FID = $id;
			$model2 -> nominated_leader_id = $model1->id;
			$model2 -> addedon = date('Ymd');
			$model2 -> save();
			Yii::$app->session->setFlash('success', "Thank you for Nominating a Leader");
			}
			else
			{
				$nominated_leader_id  = $sql['id'];
				$FID  = $id;
				$queryDetails = NominateLeaderDetails ::find()
				->where(['nominated_leader_id' => $nominated_leader_id, 'FID' => $FID])->all();
		   
			   if(!empty($queryDetails))
			   {
			   		Yii::$app->session->setFlash('error', "Sorry! You Have Already Nominated As a Leader This Person");	

			   }
			  else{
					$model2 -> FID = $id;
					$model2 -> nominated_leader_id = $nominated_leader_id;
					$model2 -> addedon = date('Ymd');
					$model2 -> save();
					Yii::$app->session->setFlash('success', "Thank you for Nominating a Leader");
			  }
			}
		}
  		return $this->render('nominate', [
				'model' => $model,
				'model1' => $model1
        ]);
  }	
    public function actionCategory($category)
    {
		 if(Yii::$app->request->isAjax)
		 {
				$data= Yii::$app->request->post(); 
				echo $category = $data['category'];
				$sql = "SELECT name FROM `categories` WHERE `countryId ` =".$category ;
				$result = Yii::$app->db->createCommand($sql)->queryAll(); 
				$search = 'success';
				\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				return [
					'result' => $search
				];
        }
	}
	public function actionFind($address)
	{	
		if(Yii::app()->request->isAjaxRequest)
		 {
			$data= Yii::$app->request->post(); 
				echo $category = $data['address'];
				echo $query = "SELECT id FROM user WHERE first_name LIKE '%".$address."%'";
				$result = Yii::$app->db->createCommand($query)->queryAll(); 
				if($result)
				{
					\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
					return [
						'result' => $result
					];
				}
				else
				{
					echo 'Failed';
				}  
		 }
	}
	public function actionFollow($fid, $lid)
	{
		$model = new Post();
		    $dataReader = Yii::$app->db->createCommand( 'SELECT * FROM post where userId !='.Yii::$app->user->identity->id.' ORDER BY id DESC ')->queryAll();
			 
			$model1 = new FollowerDetails;	
			//check if already followed
			$checkfollowedROW = Yii::$app->db->createCommand("SELECT count(*) as totdel from  follower_details WHERE FID = '".$fid."' AND LID = '".$lid."'")->queryAll();
			$totfollow = 0;
			foreach($checkfollowedROW as $row)
			{
				$totfollow = $row['totdel'];
			}
			if($totfollow==0)
			{
				$model1 -> FID = $fid;
				$model1 -> LID = $lid;
				//$model1 -> postId = $postId;
				$model1 -> save();
			}
			Yii::$app->session->setFlash('success', "Thank you for Following");	
  		return $this->redirect(['profile/my-channels']);
		/*return $this->render('profile', [
				'model1' => $model1,
				'dataReader' => $dataReader,
				'model' => $model
        ]);;*/
	}
	public function actionSearch()
	{
		if (Yii::$app->request->post()) 
		{
			$data = Yii::$app->request->post();
			$search = $data['search'];
			$sql = 'SELECT * FROM `post` WHERE `message` LIKE "%'.$search.'%" OR `image_messge`LIKE "%'.$search.'%" OR `video_message` LIKE "%'.$search.'%"  OR `to_address` LIKE "%'.$search.'%" order by id desc';
			//$dataReader = Yii::$app->db->createCommand($sql)->queryAll();
			/*return $this->render('profile', [
				'dataReader' => $dataReader
            ]);*/
			 $query  =  Post::findBySql($sql);
			$dataProviders = new ActiveDataProvider([
		'query' => $query,
		 'pagination' => [
			'pageSize' => 10,
		],
	]);   
 $dataProviders->getCount();
 $dataReader = $dataProviders->getModels();
	return $this->render('profile', [
				'dataReader' => $dataReader,
				'dataProviders' => $dataProviders
        ]);
		}
	}
	public function actionNominateleaderSearch($query, $country, $category)
	{	echo $query;
		/*if(Yii::app()->request->isAjaxRequest)
		 {
			$data= Yii::$app->request->post(); 
				echo $query = $data['query'];
				echo $query = "SELECT id FROM user WHERE first_name LIKE '%".$address."%'";
				$result = Yii::$app->db->createCommand($query)->queryAll(); 
				if($result)
				{
					\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
					return [
						'result' => $result
					];
				}
				else
				{
					echo 'Failed';
				}  
		 }*/
		 
	}
	public function actionInviteFriends()
	{
		$model = new InviteFriends();
		   if ($model->load(Yii::$app->request->post())) 
		   {
				$emailInfo = Yii::$app->request->post();			
				$emailInfo = Yii::$app->request->post();
				$email1 = $emailInfo['InviteFriends']['to_address'];			
				$email_array = explode(",",$email1);
				$messageinfo = $emailInfo['InviteFriends']['message'];
				$message = $emailInfo['InviteFriends']['message'];
				foreach($email_array as $email)
				{
					$mail = mail($email,'Friend:Info-Invitation-Link',$message,'from:admin@jijigram.com');
					if($mail)
					{
						Yii::$app->session->setFlash('success','Mail Sent Successfully');
					}
					else
					{
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
					}
			
				}
        }
		return $this->render('invite-friends', [
				'model' => $model
            ]);
	}
}
?>