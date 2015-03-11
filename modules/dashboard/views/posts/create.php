<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\models\Post $model
*/

$this->title = 'Create';
$this->params['breadcrumbs'][] = ['label' => 'Posts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	<fieldset>
        <legend><span>Creating post</span></legend>
    </fieldset>

    <?= $this->render('_form', [
    	'model' => $model,
    ]); ?>
</div>