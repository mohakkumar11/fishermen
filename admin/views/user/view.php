<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model admin\models\User */

$this->title = $model->id;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="user-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Delete', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'username',
            'first_name',
            'last_name',
            'gender',
            'auth_key',
            'password_hash',
            'confirm_password',
            'password_reset_token',
            'email:email',
            'phone',
            'status',
            'dob',
            'createdate',
            'updatedate',
            'address1',
            'usertype',
            'partyId',
            'countryId',
            'stateId',
            'address2',
            'country',
            'state',
            'city',
            'zip',
        ],
    ]) ?>

</div>
