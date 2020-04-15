<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Alert;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\UserSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>
<?php if (Yii::$app->session->hasFlash('success')): ?>
  <div class="alert alert-success alert-dismissable">
  <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
  <h4><i class="icon fa fa-check"></i>Saved!</h4>
  <?= Yii::$app->session->getFlash('success') ?>
  </div>
<?php endif; ?>
<div class="user-index">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create User', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'username',
            'first_name',
            
			[
				'attribute' => 'gender',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model ->gender == 'M')? 'Male' : 'Female';
                },
				'filter'=> ['M'=>'Male','F'=>'Female'],
			],
			[
				'attribute' => 'usertype',
				'format' => 'raw',
				'value' =>  function ($model) {
                    return ($model -> usertype == 'B')? 'Both' : (($model -> usertype == 'L')? 'Leader' : 'Follower');
                },
				'filter'=> ['B'=>'Both','F'=>'Follower', 'L' => 'Leader'],
			],
            //'auth_key',
            //'password_hash',
            //'confirm_password',
            //'password_reset_token',
            //'email:email',
            //'phone',
            //'status',
            //'dob',
            //'createdate',
            //'updatedate',
            //'address1',
            //'usertype',
            //'partyId',
            //'countryId',
            //'stateId',
            //'address2',
            //'country',
            //'state',
            //'city',
            //'zip',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
