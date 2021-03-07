<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;


/**
 * @var yii\web\View $this
 * @var app\models\Link $model
 * @var yii\bootstrap\ActiveForm $form
 */
?>

<div class="link-form">
    <h1><?= Html::encode($this->title) ?></h1>

    <?php $form = ActiveForm::begin(); ?>
    <div class="card">
        <div class="card-body">
            <?php echo $form->errorSummary($model); ?>
            <?php echo $form->field($model, 'url')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="card-footer">
            <?php echo Html::submitButton($model->isNewRecord ? 'Create' : 'Update', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>

