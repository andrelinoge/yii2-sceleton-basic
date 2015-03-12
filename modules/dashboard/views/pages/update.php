<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\Page $model
 */

$this->title = 'Page update ' . $model->title . '';
$this->params['breadcrumbs'][] = ['label' => 'Pages', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->title, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="col-md-12">
	<fieldset>
        <legend><span>Edit static page</span></legend>
    </fieldset>

    <?= $this->render('_form', [
    	'model' => $model,
    ]); ?>
</div>
