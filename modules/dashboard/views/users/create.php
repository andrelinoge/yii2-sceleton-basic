<?php

use yii\helpers\Html;

/**
* @var yii\web\View $this
* @var app\modules\dashboard\models\UserForm $model
*/

$this->title = 'Create new user';
$this->params['breadcrumbs'][] = ['label' => 'Users', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="col-md-12">
	<fieldset>
        <legend><span><?= Html::encode($this->title) ?></span></legend>
    </fieldset>

    <?= $this->render('_form', [
    	'model' => $model,
    ]); ?>
</div>