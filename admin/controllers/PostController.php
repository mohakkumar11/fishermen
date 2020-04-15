<?php
namespace admin\controllers;
use Yii;
use admin\models\Post;
use admin\models\PostSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\web\UploadedFile;
/**
 * PostController implements the CRUD actions for Post model.
 */
class PostController extends Controller
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
     * Lists all Post models.
     * @return mixed
     */
    public function actionIndex()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $searchModel = new PostSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }
    /**
     * Displays a single Post model.
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
     * Creates a new Post model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
		if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = new Post();
		$model -> addedon = date('Ymd');
 		 $request = \Yii::$app->getRequest();
    if ($request->isPost && $model->load($request->post()) && $model->validate()) {
			$image= UploadedFile::getInstance($model,'imagename');
			$video = $model->videoname = UploadedFile::getInstance($model, 'videoname');
			if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
			{
   				$image->saveAs(Yii::getAlias('@webroot/images/postImage/').'/'.$image->name);	
			    $model->imagename=$image->name;
			}
			if(isset($video -> tempName) && in_array($video->extension, array('mp4')))
			{
				$video->saveAs(Yii::getAlias('@webroot/videos/postVideo/').'/'.$video->name);	
			    $model-> videoname = $video-> name;
			}
			if($model->save())
			{
				$result = 'success';
				\Yii::$app->response->format = \yii\web\Response::FORMAT_JSON;
				 Yii::$app->session->setFlash('success', "Post Created Successfully");		
			 return $this->redirect(['index']);
			}
			else
			{
				echo 'Failed';
			} 
			Yii::$app->session->setFlash('success', "Post Created Successfully");		
			 return $this->redirect(['index']);					
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }
    /**
     * Updates an existing Post model.
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
		$filename = '';
		$filenameVideo = '';
        $model = $this->findModel($id);
		$filename = $model->imagename;
		$model->imagename = $filename;
		$filenameVideo = $model->videoname;
		$model->videoname = $filenameVideo;
		$model -> addedon = date('Ymd');
		 if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		 {
			$image = UploadedFile::getInstance($model,'imagename');
			$video = $model->videoname = UploadedFile::getInstance($model, 'videoname');
			if(isset($image))
			{
				if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
				{
					$image->saveAs(Yii::getAlias('@webroot/images/postImage/').'/'.$image->name);	
					$model->imagename = $image->name;
				}
			}
			else
			{
					$model->imagename = $filename;
				}
			if(isset($video))
			{
				if(isset($video -> tempName) && in_array($video->extension, array('mp4')))
				{
					$video->saveAs(Yii::getAlias('@webroot/videos/postVideo/').'/'.$video->name);	
					$model-> videoname = $video-> name;
				}
			}
			else
			{
					$model->videoname = $filenameVideo;
				}
			//echo '<pre>'; print_r($model);die;
			$model->save();	
			Yii::$app->session->setFlash('success', "Post Updated Successfully");	
			 return $this->redirect(['index']);
	        }
			else {
            return $this->render('update', [
                'model' => $model,
            ]);
			}
    }
    /**
     * Deletes an existing Post model.
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
		Yii::$app->session->setFlash('success', "Post Deleted Successfully");
        return $this->redirect(['index']);
    }
    /**
     * Finds the Post model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Post the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Post::findOne($id)) !== null) {
            return $model;
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }
	public function actionTest()
    {
		 if (Yii::$app->user->isGuest)		
		{		
			return $this->redirect(['site/login']);		
		}
        $model = new Post();
		$model -> addedon = date('Ymd');
		 if ($model->load(Yii::$app->request->post()) && $model->validate()) 
		{
			$image= UploadedFile::getInstance($model,'imagename');
			$video = $model->videoname = UploadedFile::getInstance($model, 'videoname');
			if(isset($image -> tempName) && in_array($image->extension, array('jpg','png','gif')))
			{
   				$image->saveAs(Yii::getAlias('@webroot/images/postImage/').'/'.$image->name);	
			    $model->imagename=$image->name;
			}
			if(isset($video -> tempName) && in_array($video->extension, array('mp4')))
			{
				$video->saveAs(Yii::getAlias('@webroot/videos/postVideo/').'/'.$video->name);	
			    $model-> videoname = $video-> name;
			}
			$model->save();	
			Yii::$app->session->setFlash('success', "Post Created Successfully");		
			 return $this->redirect(['index']);					
        } else {
            return $this->render('test', [
                'model' => $model,
            ]);
        }
	}
}