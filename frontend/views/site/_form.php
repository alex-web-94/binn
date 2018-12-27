<?php
/* @var $this yii\web\View */
/* @var $model \frontend\models\CarForm */
/* @var $form yii\widgets\ActiveForm */

use common\models\Car;
use kartik\date\DatePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

$model->date = $model->date ? date('d.m.Y', $model->date) : '';
?>

<div class="car-form">
    <div class="row">
        <div class="col-xs-12 col-sm-6">
            <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>

            <?= $form->field($model, 'status')->dropDownList(Car::$statusLabels) ?>
            <?= $form->field($model, 'title')->textInput() ?>
            <?= $form->field($model, 'categoryId')->dropDownList(Car::$category) ?>
            <?= $form->field($model, 'price')->textInput() ?>
            <?= $form->field($model, 'date')->widget(DatePicker::class, [
                'pluginOptions' => [
                    'format' => 'dd.mm.yyyy',
                    'todayHighlight' => true,
                    'clo'
                ]
            ]) ?>
            <div class="form-group">
                <?= $form->field($model, 'file')->fileInput() ?>
                <?= Html::img($model->getFullUrlImage(), [
                    'alt' => $model->title,
                    'style' => 'width:150px;'
                ]) ?>
            </div>

            <div class="form-group">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
    </div>

</div>
