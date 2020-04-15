<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use manage\models\Pages;
use manage\models\Settings;
use frontend\models\ContactForm;
class ContactController extends Controller
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
                        'roles' => ['?'],
                    ],
					 [
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['email'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					 [
                        'actions' => ['email'],
                        'allow' => true,
                        'roles' => ['@'],
                    ]
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
		$pages = Pages::findOne(['title' => 'Contact Us']);
		$settings = Settings::findOne(['settings_id' => 1]);
        return $this->render('index',
		[
            'pages' => $pages,
'model' => new ContactForm(),
			'settings' => $settings
		]
		);
    }
	
	/*
	* mail send to friend
	*/
	public function actionEmail()
	{
		$headers = 'From: info@reinhardrealestate.com' . "\r\n" .
    	'Reply-To: info@reinhardrealestate.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
		$message = '';
		$email = '';
		if(Yii::$app->request->post())
		{
			$emailInfo = Yii::$app->request->post();
			//echo '<pre>';
			//print_r($emailInfo); echo $emailInfo['ContactForm']['name'];exit;
			$message = "
						<p>Name: ".$emailInfo['ContactForm']['name']."</p>
						<p>Last Name: ".$emailInfo['ContactForm']['lastname']."</p>
						<p>Email: ".$emailInfo['ContactForm']['email']."</p>
						<p>Phone Number: ".$emailInfo['ContactForm']['phone']."</p>
						<p>Message : ".$emailInfo['ContactForm']['message']."</p>
						";
			$email = $emailInfo['ContactForm']['email'];
			$mail = mail($email, 'Contact Us', $message, $headers); 
			if($mail)
			{
				Yii::$app->session->setFlash('success','Mail Sent Successfully');
			}
			else
			{
				Yii::$app->session->setFlash('error','Sorry!could not sent mail');
			}
		}
		$pages = Pages::findOne(['title' => 'Contact Us']);
		$settings = Settings::findOne(['settings_id' => 1]);
		return $this->redirect(\Yii::$app->urlManager->createUrl('contact/index',['pages' => $pages, 'settings' => $settings]));
	}
}

?>