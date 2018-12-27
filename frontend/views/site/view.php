<?php

use common\models\Car;
use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model \common\models\Car */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Список автомобилей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="car-view panel panel-default">

    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
        <div class="clearfix"></div>
    </div>

    <div class="panel-body">
        <?= DetailView::widget([
            'model' => $model,
            'attributes' => [
                'id',
                'statusLabel',
                'title',
                'categoryLabel',
                'price',
                'url',
                [
                    'attribute' => 'date',
                    'format' => ['date', 'format' => 'php:d.m.Y'],
                ],
                [
                    'attribute' => 'created_at',
                    'format' => ['date', 'format' => 'php:d.m.Y H:i'],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'format' => 'php:d.m.Y H:i'],
                ],
                [
                    'attribute' => 'image',
                    'format' => 'raw',
                    'value' => function (Car $data) {
                        return Html::img($data->getFullUrlImage(), [
                            'alt' => $data->title,
                            'style' => 'width:300px;'
                        ]);
                    },
                ],

            ],
        ]) ?>
    </div>
    <div class="panel-footer">
        <div class="pull-right">
            <?php
            echo Html::a('<i class="glyphicon glyphicon-trash"></i> Удалить', ['delete', 'id' => $model->id], [
                'class' => 'btn btn-danger',
                'data' => [
                    'confirm' => 'Вы уверены, что хотите удалить этот элемент?',
                    'method' => 'post',
                ],
            ]);
            echo Html::a('<i class="glyphicon glyphicon-edit"></i> Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-success']);
            ?>
        </div>
        <div class="clearfix"></div>
    </div>

</div>
