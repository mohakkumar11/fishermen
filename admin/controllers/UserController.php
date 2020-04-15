<?php
namespace admin\controllers;
use Yii;
use admin\models\User;
use admin\models\UserSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * UserController implements the CRUD actions for User model.
 */
class UserController extends Controller
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
     * Lists all User models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $searchModel = new UserSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single User model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }
    /**
     * Creates a new User model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = new User();
		$model -> usertype = 'F';
		$model -> created_at = date('Ymd');
		$model -> updated_at = date('Ymd');
		$model->generateAuthKey();
        if ($model->load(Yii::$app->request->post())) {
			$uploadedFile=UploadedFile::getInstance($model,'user_pic');
		   if(isset($uploadedFile -> tempName) && in_array($uploadedFile->extension, array('jpg','png','gif')))
		   {
				$uploadedFile->saveAs(Yii::getAlias('@webroot/images/user/').$uploadedFile -> name);
				$model->user_pic = $uploadedFile -> name;	
		   }
			$model->password_hash = Yii::$app->security->generatePasswordHash($model->password_hash);
			$model->save();
			Yii::$app->session->setFlash('success', "User Created Successfully");	
            return $this->redirect(['index', 'id' => $model->id]);
        }
        return $this->render('create', [
            'model' => $model,
        ]);
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
        if ($model->load(Yii::$app->request->post())) {
			$image = UploadedFile::getInstance($model,'user_pic');
			if(isset($image))
			{
				if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
				{
					$image->saveAs(Yii::getAlias('@webroot/images/user/').'/'.$image->name);	
					$model->user_pic = $image;
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
    /**
     * Deletes an existing User model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $this->findModel($id)->delete();
		Yii::$app->session->setFlash('success', "User Deleted Successfully");	
        return $this->redirect(['index']);
    }
    /**
     * Finds the User model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return User the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = User::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
}