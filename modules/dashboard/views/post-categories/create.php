<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\PostCategory */

$this->title = 'Create Post Category';
$this->params['breadcrumbs'][] = ['label' => 'Post Categories', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="col-md-12">
	<fieldset>
        <legend><span><?= Html::encode($this->title) ?></span></legend>
    </fieldset>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
