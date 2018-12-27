<?php

namespace frontend\models;

use common\models\Car;
use Yii;
use yii\helpers\ArrayHelper;


class CarForm extends Car
{
    public $file;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // Необходимо написать правила валидации
        return ArrayHelper::merge(parent::rules(), [
            [['status', 'title', 'categoryId', 'price', 'date'], 'required'],
            ['file', 'file', 'maxSize' => 15 * 1024 * 1024, 'extensions' => 'png, jpg']
        ]);
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'file' => Yii::t('app', 'Изображение'),
        ]);

    }
}
