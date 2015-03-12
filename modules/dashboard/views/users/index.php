<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\UserSearch $searchModel
*/

$this->title = 'Users';
$this->params['breadcrumbs'][] = $this->title;
?>

<? Pjax::begin() ?>
    <div class="col-md-12">

        <div class="clearfix">
            <p class="pull-left">
                <?= Html::a('<span class="glyphicon glyphicon-plus"></span> New User', ['create'], ['class' => 'btn btn-success', 'data-pjax' => 0]) ?>
            </p>
        </div>

    
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns' => [
    			'id',
    			'name',
                'email',
                'created_at:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'urlCreator' => function($action, $model, $key, $index) {
                        $params = is_array($key) ? $key : [$model->primaryKey()[0] => (string) $key];
                        $params[0] = \Yii::$app->controller->id ? \Yii::$app->controller->id . '/' . $action : $action;
                        return \yii\helpers\Url::toRoute($params);
                    },
                    'contentOptions' => ['nowrap'=>'nowrap']
                ],
            ],
        ]) ?>
    </div>
<? Pjax::end() ?>