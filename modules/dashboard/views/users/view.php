<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
* @var yii\web\View $this
* @var app\models\User $model
*/

$this->title = 'User ' . $model->name . '';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="post-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id],
        ['class' => 'btn btn-info']) ?>
    </p>

        <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p><div class='clearfix'></div> 

    
    <h3><?= $model->name ?></h3>


    <? $this->beginBlock('\app\models\User'); ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    		'id',
    		'name',
            'email',
    		'created_at:date',
        ],
    ]); ?>

    <hr/>

    <?= Html::a('<span class="glyphicon glyphicon-trash"></span> Delete', ['delete', 'id' => $model->id],
    [
    'class' => 'btn btn-danger',
    'data-confirm' => Yii::t('app', 'Are you sure to delete this item?'),
    'data-method' => 'post',
    ]); ?>

    <? $this->endBlock(); ?>

    <?= \yii\bootstrap\Tabs::widget([
        'id' => 'relation-tabs',
        'encodeLabels' => false,
        'items' => [ [
            'label'   => '<span class="glyphicon glyphicon-asterisk"></span> User',
            'content' => $this->blocks['\app\models\User'],
            'active'  => true,
        ], ]
    ]) ?>
</div>