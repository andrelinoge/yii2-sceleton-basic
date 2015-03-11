<?

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var app\models\Post $model
* @var yii\bootstrap\ActiveForm $form
*/
?>

<? $form = ActiveForm::begin([
    'layout'                 => 'horizontal', 
    'enableClientValidation' => false, 
    'fieldConfig' => [
        'horizontalCssClasses'   => [
            'label' => 'col-sm-2'
        ]
    ]
]) ?>

    <?= $form->errorSummary($model); ?>

        
	<?= $form->field($model, 'title')->textInput(['maxlength' => 255]) ?>
	<?= $form->field($model, 'content')->textarea(['rows' => 6]) ?>
	<?= $form->field($model, 'category_id')->textInput() ?>

    <hr/>

    <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> '.($model->isNewRecord ? 'Create' : 'Save'), ['class' => $model->isNewRecord ?
    'btn btn-primary' : 'btn btn-primary']) ?>
    <?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>

<? ActiveForm::end(); ?>