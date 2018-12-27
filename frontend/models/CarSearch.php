<?php

namespace frontend\models;

use common\models\Car;
use yii\data\ActiveDataProvider;
use yii\helpers\ArrayHelper;


class CarSearch extends Car
{
    public $date_min;
    public $date_max;
    public $price_min;
    public $price_max;

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['date_min', 'date_max'], 'datetime', 'format' => 'php:d.m.Y'],
            [['date_min', 'date_max'], 'filter', 'filter' => function ($value) {
                return strtotime($value);
            }],
            [['price_min', 'price_max'], 'number'],
            [['categoryId'], 'integer'],
        ];
    }

    /**
     * @param $params
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Car::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => ['date', 'updated_at'],
                'defaultOrder' => [
                    'updated_at' => SORT_DESC
                ]
            ],
            'pagination' => [
                'pageSize' => $this->pageSize
            ]
        ]);

        $this->load($params);

        if (!$this->load($params) || !$this->validate()) {
            return $dataProvider;
        }

        $query->andFilterWhere([
            'categoryId' => $this->categoryId,
        ]);
        if ($this->date_min) {
            $query->andWhere(['>=', 'date', $this->date_min]);
        }
        if ($this->date_max) {
            $query->andWhere(['<=', 'date', $this->date_max + 3600 * 23 + 3599]);
        }
        $query->andFilterWhere(['>=', 'price', $this->price_min]);
        $query->andFilterWhere(['<=', 'price', $this->price_max]);


        return $dataProvider;
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return ArrayHelper::merge(parent::attributeLabels(), [
            'date_min' => \Yii::t('app', 'Дата выпуска от'),
            'date_max' => \Yii::t('app', 'Дата выпуска до'),
            'price_min' => \Yii::t('app', 'Цена от'),
            'price_max' => \Yii::t('app', 'Цено до'),
        ]);

    }
}
