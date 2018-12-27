<?php
/**
 * @var $this yii\web\View
 * @var $searchModel frontend\models\CarSearch
 * @var $dataProvider yii\data\ActiveDataProvider
 */

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Список автомобилей';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-index panel panel-default">
    <?php Pjax::begin(); ?>
    <div class="panel-heading">
        <div class="pull-right">
            <?= Html::button('<i class="glyphicon glyphicon-filter"></i> Фильтр', [
                'class' => 'btn btn-primary',
                'data-toggle' => 'collapse',
                'data-target' => '#filtersValiant'
            ]) ?>
        </div>
        <h1><?= Html::encode($this->title) ?></h1>
        <?php
        echo $this->render('_search', ['model' => $searchModel]);
        ?>
        <div class="pull-right">
            <?= Html::a('<i class="glyphicon glyphicon-plus"></i> Добавить', ['create'], ['class' => 'btn btn-success']) ?>
        </div>
        <div class="clearfix"></div>
    </div>
    <div class="panel-body">
        <?= GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                'id',
                'title',
                'categoryLabel',
                'price',
                [
                    'attribute' => 'date',
                    'format' => ['date', 'format' => 'php:d.m.Y'],
                ],
                [
                    'attribute' => 'updated_at',
                    'format' => ['date', 'format' => 'php:d.m.Y'],
                ],
                'statusLabel',
                [
                    'class' => yii\grid\ActionColumn::class
                ],
            ],
        ]); ?>
    </div>
    <?php Pjax::end(); ?>
</div>
