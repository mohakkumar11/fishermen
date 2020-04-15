<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\LoginForm;
use frontend\models\PasswordResetRequestForm;
use frontend\models\ResetPasswordForm;
use frontend\models\SignupForm;
use frontend\models\ContactForm;
use admin\models\Pages;
use admin\models\Settings;
use manage\models\Testimonials;
use yii\helpers\Url;
use admin\models\LeaderInvite;
use admin\models\User;
/**
 * Site controller
 */
class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout', 'signup'],
                'rules' => [
                    [
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['signup'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['login', 'pages'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['login', 'pages'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['rsvp'],
                        'allow' => true,
                        'roles' => ['*'],
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
		return $this->redirect(['site/login']);
    }
    /**
     * Logs in a user.
     *
     * @return mixed
     */
    public function actionLogin()
    {
         $model = new LoginForm();
        if (($model->load(Yii::$app->request->post()) && $model->login()) || (Yii::$app->user->identity && Yii::$app->user->identity->username !== '')) 
		{
 			Yii::$app->response->redirect(Url::to(['profile/my-post'], true));
        } 
		else {
            return $this->render('login', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Logs out the current user.
     *
     * @return mixed
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();
		return $this->redirect(['site/login']);
        //return $this->goHome();
    }
    /**
     * Displays contact page.
     *
     * @return mixed
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->validate()) {
            if ($model->sendEmail(Yii::$app->params['adminEmail'])) {
                Yii::$app->session->setFlash('success', 'Thank you for contacting us. We will respond to you as soon as possible.');
            } else {
                Yii::$app->session->setFlash('error', 'There was an error sending your message.');
            }
            return $this->refresh();
        } else {
            return $this->render('contact', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Displays about page.
     *
     * @return mixed
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    /**
     * Signs user up.
     *
     * @return mixed
     */
    public function actionSignup()
    {
        $model = new SignupForm();
 		$query = $_SERVER['QUERY_STRING'];
	 
		//$model1 = LeaderInvite::find()->all();
		$user = new User();
        if ($model->load(Yii::$app->request->post())) {
 		/*$model1 = LeaderInvite::find()->orderBy(['id'=>SORT_DESC,])->all();
		foreach($model1 as $led){
		$led1= $led['code']; 
		}
		if($query==$led1){
		$user->usertype = 'L'; 
		}*/	
            if ($user = $model->signup()) { 
				$email = $user->email;
				$mail =  Yii::$app->mailer->compose()		  
				 ->setFrom('admin@findingcivility.com')
				 //->setTo($emailInfo['LeaderInvite']['email'])
				 ->setTo($email)
				 ->setSubject('Registration Confirmation Mail')
				 ->setHtmlBody('
				 Dear Finding Civility User,<br><br>
				 Thanks for signing up to Finding Civility.<br>
				 You can start nominating people now.<br><br>
				 Thank You, <br>
				 The Finding Civility Team.<br><br>
				 <a href="https://www.findingcivility.com/site/login">Please Click Here To Login</a>')
			 	->send();
			   if($mail)
			   {		
					Yii::$app->session->setFlash('success','Your sign up was successful. An email will be sent to you. Please check your email.');
			   }
			   else
			   {
					Yii::$app->session->setFlash('error','Sorry!could not sent mail');
			   }
		    return $this->redirect(['site/login']);
            }
        }
        return $this->render('signup', [
            'model' => $model,
        ]);
    }
    /**
     * Requests password reset.
     *
     * @return mixed
     */
    public function actionRequestPasswordReset()
    {
        $model = new PasswordResetRequestForm();
       	if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		{
			$token = $model->sendEmail();
			 $modelUser = new User();
			 $email = $_POST['PasswordResetRequestForm']['email'];
			 $Query = User::find()
			->select(['password_reset_token'])
			->from('user')
			->where(['email' => $email])
			->limit(10)
			->all();
 			foreach($Query as $val)
			{
				$token = $val-> password_reset_token;
			}
 				if ($token!= '') {
					Yii::$app->session->setFlash('success', 'Check your email for further instructions.');
 					$model2 = new ResetPasswordForm($token);
 					 return $this->render('index', [
				'model' => $model2,
				'token' => $token
			]);
				} else {
					Yii::$app->session->setFlash('error', 'Sorry, we are unable to reset password for the provided email address.');
				}
        }
        return $this->render('requestPasswordResetToken', [
            'model' => $model,
        ]);
    }
    /**
     * Resets password.
     *
     * @param string $token
     * @return mixed
     * @throws BadRequestHttpException
     */
    public function actionResetPassword($token)
    {  
        try {
            $model = new ResetPasswordForm($token);
        } catch (InvalidParamException $e) {
            throw new BadRequestHttpException($e->getMessage());
        }
        if ($model->load(Yii::$app->request->post()) && $model->resetPassword()) {
            Yii::$app->session->setFlash('success', 'New password saved.');
         }
         return $this->render('resetPassword', [
            'model' => $model,
        ]);
     }
	 /**
     * pages
     * @page string
     */
    public function actionPages($page)
    {
		 $model = new Pages(); 
		 if($page == 'help') 
		 {
			$sql = Pages::find()
        ->where(['title' => 'Help Center'])
        ->one();	 
		 }
		 else if($page == 'privacy')
		 {
				$sql = Pages::find()
        ->where(['title' => 'Privacy Policy'])
        ->one();
		  }
		  else if($page == 'conduct')
		 {
				$sql = Pages::find()
        ->where(['title' => 'Code Of Conduct'])
        ->one();
		  }
         return $this->render('page', [
            'model' => $model,
			'sql' => $sql,
        ]);
     }
	 /**
     * rsvp register
     * @page string
     */
    public function actionRsvp()
    {
		$model = new SignupForm(); 
		if ($model->load(Yii::$app->request->post())) 
		{
			 $query = Settings::find()->one();
			 $toemail = $query['admin_email'];
			  $first_name = $_POST['SignupForm']['first_name'];
			  $email = $_POST['SignupForm']['email'];
			   //$usertype = $_POST['SignupForm']['usertype'];
			  //$countryId = $_POST['SignupForm']['countryId'];
			  $mail =  Yii::$app->mailer->compose()		  
				 ->setFrom('admin@findingcivility.com')
				 ->setTo($toemail)
				 ->setSubject('Leader Rsvp')
				 ->setHtmlBody('
				 <b>Hi, Please Accepted My Request As A Leader</b><br>
				 My Details - <br>
				 <b>Name </b>- '.$first_name.' <br>
				 <b>Email Id </b>- '.$email.' <br>
				 <b>User Type </b>- Leader <br>
				 <br>')
				 ->send();
			   if($mail)
			   {		
					Yii::$app->session->setFlash('success','Mail Sent Successfully');
			   }
			   else
			   {
					Yii::$app->session->setFlash('error','Sorry!could not sent mail');
			   }
		}
         return $this->render('rsvp', [
            'model' => $model
        ]);
     }
	  /**
     * rsvp register
     * @page string
     */
    public function actionLeaderSignup()
    { 
        $model = new SignupForm();
		$user = new User();
		$leaderinvite = new LeaderInvite();
         if ($model->load(Yii::$app->request->post()) && $model->validate()) {
			 $leader = Yii::$app->request->post();
			 $code = $leader['LeaderInvite']['code'];
			 $inviteLeader = LeaderInvite::find()->andFilterWhere(['or', ['like', 'code', $code]])->one();
			 $uniqueCode = $inviteLeader['code'];
			 if($uniqueCode == $code){
				 $user->usertype ='L';	
					$leaderinvite->status ='R';		
				if ($user = $model->signup()) {
					$user->usertype ='L';
					$user-> save();	
					$inviteLeader->status ='R';	 
					$inviteLeader-> save();
					$email = $user->email;
					$mail =  Yii::$app->mailer->compose()		  
					 ->setFrom('admin@findingcivility.com')
					 //->setTo($emailInfo['LeaderInvite']['email'])
					 ->setTo($email)
					 ->setSubject('Registration Confirmation Mail')
					 ->setHtmlBody('
				 Dear Finding Civility User,<br><br>
				 Thanks for signing up to Finding Civility.<br>
				 You can start nominating people now.<br><br>
				 Thank You, <br>
				 The Finding Civility Team.<br><br>
					 <a href="https://www.findingcivility.com/site/login">Please Click Here To Login</a>')
					->send();
				   if($mail)
				   {		
						Yii::$app->session->setFlash('success','Your sign up was successful. An email will be sent to you. Please check your email.');
				   }
				   else
				   {
						Yii::$app->session->setFlash('error','Sorry!could not sent mail');
				   }
				return $this->redirect(['site/login']);
				}
			 }
			 else
			 {
				Yii::$app->session->setFlash('error','Sorry! Wrong Code. Could not Sign Up.Please Give Your Right Code'); 
			}
        }
        return $this->render('leadersignup', [
            'model' => $model,
			'user' => $user,
			'leaderinvite' => $leaderinvite,
        ]);
    
	}
	 /**
     * rsvp register
     * @page string
     */
    public function actionContactUs()
    {
		$model = new SignupForm(); 
		if (Yii::$app->request->post()) 
		{
			$model = new Settings();
			$settings = Settings::find()->one();	
			$admin_email = $settings -> admin_email;
			$Full_Name = Yii::$app->request->post('Full_Name');
			$email_id = Yii::$app->request->post('email_id');
			$Mobile_No = Yii::$app->request->post('Mobile_No');
			$comment = Yii::$app->request->post('comment');
			$mail =  Yii::$app->mailer->compose()		  
			 ->setFrom('admin@findingcivility.com')
			 //->setTo($emailInfo['LeaderInvite']['email'])
			 ->setTo($admin_email)
			 ->setSubject('Contact Us')
			 ->setHtmlBody('
			 <b>Dear Finding Civility Admin,<br>
			 New Submitted Contact Us User Information is below here - </b><br>
			  Details are here - <br>
			 <b>Name </b>- '.$Full_Name.' <br>
			 <b>Email Id </b>- '.$email_id.' <br>
			 <b>Mobile_No </b>- '.$Mobile_No.' <br>
			 <b>comment </b>- '.$comment.' <br>
			 <br>')
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
         return $this->render('contactus', [
            'model' => $model
        ]);
     }
}