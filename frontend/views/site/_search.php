<?php
/* @var $this yii\web\View */
/* @var $model frontend\models\CarSearch */
/* @var $form yii\widgets\ActiveForm */

use common\models\Car;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model->date_min = $model->date_min ? date('d.m.Y', $model->date_min) : '';
$model->date_max = $model->date_max ? date('d.m.Y', $model->date_max) : '';
?>
<div class="car-search collapse" id="filtersValiant">

    <?php $form = ActiveForm::begin(['method' => 'get', 'options' => ['data-pjax' => 1]]); ?>
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'date_min')->widget(DatePicker::class, ['pluginOptions' => ['format' => 'dd.mm.yyyy',
                'todayHighlight' => true]]) ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'date_max')->widget(DatePicker::class, ['pluginOptions' => ['format' => 'dd.mm.yyyy',
                'todayHighlight' => true]]) ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'categoryId')->dropDownList(Car::$category, ['prompt' => '']) ?>
        </div>
    </div>
    <div class="row">
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'price_min') ?>
        </div>
        <div class="col-xs-6 col-sm-3">
            <?= $form->field($model, 'price_max') ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сбросить', ['/'], ['class' => 'btn btn-default', 'data-pjax' => 0]) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
