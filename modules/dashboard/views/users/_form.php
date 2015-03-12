<?

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

/**
* @var yii\web\View $this
* @var app\modules\dashboard\models\UserForm $model
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
    ],
    'options' => ['enctype' => 'multipart/form-data']
]) ?>

    <?= $form->errorSummary($model); ?>

        
	<?= $form->field($model, 'name')->textInput(['maxlength' => 255]) ?>
    <?= $form->field($model, 'email')->textInput(['maxlength' => 255]) ?>
	<?= $form->field($model, 'password')->textInput(['maxlength' => 255]) ?>

    <hr/>

    <?= Html::submitButton('<span class="glyphicon glyphicon-check"></span> Save', ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Cancel', \yii\helpers\Url::previous(), ['class' => 'btn btn-default']) ?>

<? ActiveForm::end(); ?>