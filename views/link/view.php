<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/**
 * @var yii\web\View $this
 * @var app\models\Link $model
 */

$this->title = $model->hash;
$this->params['breadcrumbs'][] = ['label' => 'List', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-view">
    <div class="row">
        <div class="col-xs-6">
            <h1 style="margin: 0; line-height: 34px;"><?= $this->title ?></h1>
        </div>
        <div class="col-xs-6">
            <p class="text-right">
                <?php echo Html::a('Update', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
                <?php echo Html::a('Delete', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Are you sure you want to delete this item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </p>
        </div>
    </div>
    <div class="card">
        <div class="card-body">

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'url:url',
                    'short_url:url',
                    'counter',
                    'created_at:datetime',
                    'updated_at:datetime',
                ],
            ]) ?>
        </div>
    </div>
</div>