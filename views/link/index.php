<?php

use yii\helpers\Html;
use yii\grid\GridView;

/**
 * @var yii\web\View $this
 * @var yii\data\ActiveDataProvider $dataProvider
 */

$this->title = 'List';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="link-index">

    <div class="row">
        <div class="col-xs-6">
            <h1 style="margin: 0; line-height: 34px;"><?= $this->title ?></h1>
        </div>
        <div class="col-xs-6">
            <p class="text-right">
                <?php echo Html::a('Create URL', ['create'], ['class' => 'btn btn-success']) ?>
            </p>
        </div>
    </div>
    <div class="card">

        <div class="card-body p-0">

            <?php echo GridView::widget([
                'layout' => "{items}\n{pager}",
                'options' => [
                    'class' => ['gridview', 'table-responsive'],
                ],
                'tableOptions' => [
                    'class' => ['table', 'text-nowrap', 'table-striped', 'table-bordered', 'mb-0'],
                ],
                'dataProvider' => $dataProvider,
                'columns' => [
                    ['class' => 'yii\grid\SerialColumn'],

                    'url',
                    'short_url',
                    'counter',
                    'created_at:datetime',
                    // 'updated_at',

                    [
                        'class' => 'yii\grid\ActionColumn',
                        'contentOptions' => [
                            'class' => 'text-center'
                        ],
                        'buttonOptions' => [
                            'class' => 'action-button'
                        ]
                    ]
                ],
            ]); ?>

        </div>
    </div>

</div>