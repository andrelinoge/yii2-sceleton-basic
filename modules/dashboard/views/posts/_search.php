<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\PostSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="post-search">

	<div class="col-md-12">
		<h4>Search</h4>
		<hr/>

		<? $form = ActiveForm::begin([
			'action' => ['index'],
			'method' => 'get',
		]); ?>
			<div class="row">
				<div class="col-md-6">
					<?= $form->field($model, 'title') ?>
				</div>
				<div class="col-md-6">
					<?= $form->field($model, 'category_id') ?>
				</div>
			</div>


			<div class="form-group">
				<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
				<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
			</div>

		<? ActiveForm::end(); ?>
	</div>
</div>