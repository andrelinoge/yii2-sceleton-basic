<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\helpers\StringHelper;
use yii\widgets\Pjax;

/**
* @var yii\web\View $this
* @var yii\data\ActiveDataProvider $dataProvider
* @var app\models\Page $searchModel
*/

$this->title = 'Pages';
$this->params['breadcrumbs'][] = $this->title;
?>

<? Pjax::begin() ?>
    <div class="col-md-12">

        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'columns' => [
    			'title',
    			[
                    'attribute' => 'content',
                    'value'     => function ($model, $key, $index, $column) {
                        return StringHelper::truncate(strip_tags($model->content), 100);
                    }
                ],
                [
                    'class' => 'yii\grid\ActionColumn',
                    'template' => '{update} {view}',
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