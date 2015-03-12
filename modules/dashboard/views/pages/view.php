<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var app\models\Page $model
*/

$this->title = 'Page View ' . $model->title . '';
$this->params['breadcrumbs'][] = ['label' => 'Page', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'View';
?>
<div class="page-view">

    <p class='pull-left'>
        <?= Html::a('<span class="glyphicon glyphicon-pencil"></span> Edit', ['update', 'id' => $model->id],
        ['class' => 'btn btn-info']) ?>
    </p>

    <p class='pull-right'>
        <?= Html::a('<span class="glyphicon glyphicon-list"></span> List', ['index'], ['class'=>'btn btn-default']) ?>
    </p>
    <div class='clearfix'></div> 

    
    <h3><?= $model->title ?></h3>


    <? $this->beginBlock('\app\models\Page') ?>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
    		'title',
            'slug',
    		'content:html',
        ],
    ]) ?>

    <? $this->endBlock(); ?>


    
    <?= \yii\bootstrap\Tabs::widget([
            'id' => 'relation-tabs',
            'encodeLabels' => false,
                'items' => [ 
                    [
                        'label'   => '<span class="glyphicon glyphicon-asterisk"></span> Static page',
                        'content' => $this->blocks['\app\models\Page'],
                        'active'  => true,
                    ], 
            ]
    ])?>
</div>