<?php
namespace frontend\controllers;
use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
class FriendController extends \yii\web\Controller
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
                        'actions' => ['email'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['index'],
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
		return $this->render('index');
    }
	/*
	* mail send to friend
	*/
	public function actionEmail()
	{
		$headers = 'From: info@kusdemos.com' . "\r\n" .
    	'Reply-To: info@kusdemos.com' . "\r\n" .
    	'X-Mailer: PHP/' . phpversion();
		$message = '';
		$email = '';
		if(Yii::$app->request->post())
		{
			$emailInfo = Yii::$app->request->post();
			$message = $emailInfo['message'];
			$email = $emailInfo['email'];
			$mail = mail($email,'Friend:Info',$message,'from:info@kusdemos.com');
			if($mail)
			{
				Yii::$app->session->setFlash('success','Mail Sent Successfully');
			}
			else
			{
				Yii::$app->session->setFlash('error','Sorry!could not sent mail');
			}
		}
		return $this->render('index');
	}
}
?>