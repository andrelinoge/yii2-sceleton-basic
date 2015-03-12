<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/**
 * @var yii\web\View $this
 * @var app\models\UserSearch $model
 * @var yii\widgets\ActiveForm $form
 */
?>

<div class="col-md-12">
	<div class="row">
		<h4>Search</h4>
	</div>

	<div class="row">
		<? $form = ActiveForm::begin([
			'action'      => ['index'],
			'method'      => 'get',
			'options'     => ['data-pjax'   => true],
			'fieldConfig' => [
		        'template' => '{input}{error}',
		    ],
		]); ?>

		<div class="col-md-4">
			<?= $form->field($model, 'name')->textInput(['placeholder' => 'User name']) ?>
		</div>
		
		<div class="col-md-4">
			<?= $form->field($model, 'email')->textInput(['placeholder' => 'Title']) ?>
		</div>

		<div class="col-md-4">
			<div class="form-group">
				<?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
				<?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
			</div>
		</div>

		<? ActiveForm::end(); ?>
	</div>
</div>