<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
use yii\helpers\StringHelper;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\ContactMessageSearch $searchModel
*/

$this->title = 'Contact Messages';
$this->params['breadcrumbs'][] = $this->title;
?>

<? Pjax::begin() ?>
    <div class="col-md-12">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel'  => $searchModel,
            'columns' => [
    			'id',
    			'subject',
    			'name',
    			'email',
    			[
                    'attribute' => 'content',
                    'value'     => function ($model, $key, $index, $column) {
                        return StringHelper::truncate($model->content, 100);
                    }
                ],
                
                [
                    'class' => 'yii\grid\ActionColumn',
                	'template' => '{view} {delete}',
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