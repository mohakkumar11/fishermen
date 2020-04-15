<?php
namespace admin\controllers;
use Yii;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
/**
 * DashboardController implements the CRUD actions for Testimonials model.
 */
class DashboardController extends Controller
{
    /**
     * @inheritdoc
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
     * Lists all Testimonials models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        return $this->render('index', [
        ]);
    }
}