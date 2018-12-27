<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model \frontend\models\CarForm */

$this->title = 'Добавить';
$this->params['breadcrumbs'][] = ['label' => 'Список автомобилей', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="car-create panel panel-default">

    <div class="panel-heading">
        <h1><?= Html::encode($this->title) ?></h1>
    </div>
    <div class="panel-body">

        <?= $this->render('_form', [
            'model' => $model,
        ]) ?>

    </div>
</div>
