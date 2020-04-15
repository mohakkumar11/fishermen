<?php
namespace admin\controllers;
use Yii;
use admin\models\Companies;
use admin\models\Categories; 
use admin\models\Comments;
use admin\models\CompaniesSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;

/**
 * LeaderInviteController implements the CRUD actions for LeaderInvite model.
 */
class TestController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all LeaderInvite models.
     * @return mixed
     */
    public function actionIndex()
    {
        $mail =  Yii::$app->mailer->compose()		  
			 ->setFrom('kussoftware@gmail.com')
			 ->setTo('kussoftware05@gmail.com')
			 
			 ->send();
			 
			 if($mail)
			 {
				 echo 'sent';
				 }
				 else{
					 echo 'not sent';
					 }
    }

    
}
