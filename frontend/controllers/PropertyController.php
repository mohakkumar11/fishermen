<?php
namespace frontend\controllers;

use Yii;
use yii\base\InvalidParamException;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use manage\models\Property;
use manage\models\PropertyImage;
class PropertyController extends Controller
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
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['index'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['details'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['details'],
                        'allow' => true,
                        'roles' => ['?'],
                    ],
					[
                        'actions' => ['search'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
					[
                        'actions' => ['search'],
                        'allow' => true,
                        'roles' => ['?'],
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
		$sql = "SELECT * 
		  FROM property p
		  INNER JOIN property_image i 
		  on p.id = i.property_id 
		  WHERE p.featured = 'Y' AND
		  i.is_default = 'Y'
		  ";
		$model = Yii::$app->db->createCommand($sql)->queryAll(); 
        return $this->render('index',['model' => $model,
			]);
    }
	/*
	* Property details
	* parameter -> propertyid
	* return -> propertydetaails and image details
	*/
	public function actionDetails($id)
	{
	  /*$propertyImages = PropertyImage::find()
	  		->where(['property_id' => $id])
			->orderBy('id')
			->all();*/
		$propertyImages = PropertyImage::find()
	  		->where(['property_id' => $id])
			->orderBy('id DESC')
			->one()
			;	
	  $model = Property::find()
		->where(['id' => $id])
		->orderBy('id')
		->one();
	  
		return $this->render('propertyDetails',['model' => $model,
			'propertyImages' => $propertyImages
	   ]);
	}
	/*
	* search by address, city, state and zipcode
	*/
	public function actionSearch()
	{
		$search = '';
		if(Yii::$app->request->post())
		{
			$searchInfo = Yii::$app->request->post();
			if($searchInfo['state_name'])
			{
				$search = $searchInfo['search'];
			}
			if($searchInfo['state_name'])
			{
				$search = $searchInfo['state_name'];
			}
		}
		$sql = "SELECT * 
		  FROM property p
		  INNER JOIN property_image i 
		  on p.id = i.property_id 
		  WHERE p.featured = 'Y' AND
		  (p.address LIKE '%".$search."%'
		  OR p.area LIKE '%".$search."%'
		  OR p.state = ".$search."
		  OR p.zip =".$search."
		  )
		  AND i.is_default = 'Y'
		  ORDER BY p.id DESC
		  ";
		$model = Yii::$app->db->createCommand($sql)->queryAll(); 
		return $this->render('index',[
			'model' => $model,
	   		]);
	}
}

?>