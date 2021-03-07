<?php

/**
 * @var yii\web\View $this
 * @var app\models\Link $model
 */

$this->title = 'Create URL';
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-create">

    <?php echo $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>