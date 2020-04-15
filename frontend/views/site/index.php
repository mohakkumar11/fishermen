<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use admin\models\NominatedLeaderDetails;
use yii\data\ActiveDataProvider;

/* @var $this yii\web\View */
/* @var $searchModel admin\models\LeaderInviteSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

//$this->title = 'Nominate Leader Lists';
$this->params['breadcrumbs'][] = $this->title;
$this->registerJs(
    '$("document").ready(function(){
	 window.setTimeout(function () {
        location.href = "http://www.findingcivility.com/site/login";
    }, 1000);
		});'
    );
?>
