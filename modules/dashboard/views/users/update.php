<?php

use yii\helpers\Html;

/**
 * @var yii\web\View $this
 * @var app\models\User $model
 */

$this->title = 'User update: ' . $model->name ;
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => (string)$model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Edit';
?>

<div class="col-md-12">
	<fieldset>
        <legend><span>Updating user</span></legend>
    </fieldset>

    <?= $this->render('_form', [
    	'model' => $model,
    ]); ?>
</div>
