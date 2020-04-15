<?php

use yii\helpers\Html;
//use yii\bootstrap\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;
use yii\helpers\ArrayHelper;
use admin\models\User;
use yii\widgets\Pjax;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\PostSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Posts';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<div class="post-index">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Post', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
    $user= User::find()->all();
	$listData=ArrayHelper::map($user,'id','first_name');
	?>
<?php Pjax::begin(['id' => 'postIndex']) ?>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
           // 'id',         
         	[
				'attribute' => 'userId',
				//'format' => 'text',
				'value' => function($data){
                     // return $data->user->first_name;
					 //return $data->user?$data->user->first_name:$data->userId;
					 return $data->user ? $data->user->first_name : '';
                   },
				'filter'=> ['empty'=>'Select User',$listData],
			],
		   [
				'attribute' => 'message',
				'format' => 'text',
				'value' =>  function ($model) {
                    return strip_tags($model->message);
                },
			],
			[
				'attribute' => 'imagename',
				'format' => 'html',
				'label' => 'Image Name',
				'value' => function ($model) {
					$img = Yii::$app->request->baseUrl.'/images/postImage/'.$model->imagename;
					if($model->imagename != '')
					{
                    	return Html::img($img, ['alt'=>'PostImage','width'=>'150','height'=>'100']);
					}
					else{
							return 'No Image Uploaded';
						}
                },
				'filter'=> false
			],
			
			[
				'attribute' => 'videoname',
				'format' => 'raw',
				'label' => 'Video Name',
				
				'value' => function ($model) {
					$url = Yii::$app->request->baseUrl.'/videos/postVideo/'.$model->videoname;
					if($model->videoname != '')
					{
                    return '<video width="150" height="100" controls>
                              <source src= "'.$url.'" type="video/mp4">
                            </video>' ;
					}
					else{
						return 'No video Uploaded';
						}
							},
				'filter'=> false
			],
			[
				'attribute' => 'status',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->status == 'Y')? 'Active' : 'In-Active';
                },
				'filter'=> ['Y'=>'Active','N'=>'In-Active'],
			],

            //'addedon',
            //'totalvotetodelete',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end() ?>
</div>
