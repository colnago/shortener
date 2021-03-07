<?php

/**
 * @var yii\web\View $this
 * @var app\models\Link $model
 */

$this->title = 'Update URL: ' . ' ' . $model->hash;
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->hash, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Update';
?>
<div class="link-update">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>