<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model admin\models\User */

$this->title = 'Update User';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'username' => $model->username]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="user-update">

    <h1><?php /*?><?= Html::encode($this->title) ?><?php */?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
