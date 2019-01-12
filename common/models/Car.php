<?php
namespace common\models;

use common\components\behaviors\Slug;
use yii\behaviors\TimestampBehavior;
use yii\db\ActiveRecord;
use yii\helpers\Url;

/**
 * Автомобили.
 *
 * @property integer $id         Id
 * @property integer $status     Статус видимости (0 - не опубликован, 1-опубликован)
 * @property integer $categoryId Модельный ряд
 * @property string $title      Название
 * @property string $image      Изображение
 * @property integer $price      Цена
 * @property integer $date       Дата выпуска
 * @property string $url        Ссылка на автомобиль
 * @property integer $created_at Дата создания
 * @property integer $updated_at Дата обновления
 * @property integer $statusLabel
 * @property integer $categoryLabel
 */
class Car extends ActiveRecord
{
    const STATUS_PUBLISHED = 1;
    const STATUS_UNPUBLISHED = 0;
    /**
     * Путь к папке с загруженными фото.
     */
    const PATH_UPLOAD_PHOTO = '/upload/car/img/';

    /**
     * Количество отображаемых элементов в списке.
     */
    public $pageSize = 5;
    public static $category = [
        1 => 'Ниссан',
        2 => 'Вольво',
        3 => 'Форд'
    ];

    public static $statusLabels = [
        self::STATUS_PUBLISHED => 'Опубликован',
        self::STATUS_UNPUBLISHED => 'Не опубликован',
    ];

    /**
     * @return string
     */
    public function getStatusLabel()
    {
        return static::$statusLabels[$this->status];
    }

    /**
     * @return string
     */
    public function getCategoryLabel()
    {
        return static::$category[$this->categoryId];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        // Необходимо написать правила валидации
        return [
            ['date', 'datetime', 'format' => 'php:d.m.Y'],
            ['date', 'filter', 'filter' => function ($value) {
                return strtotime($value);
            }],
            ['status', 'in', 'range' => [self::STATUS_PUBLISHED, self::STATUS_UNPUBLISHED]],
            [['categoryId', 'price', 'created_at', 'updated_at'], 'integer'],
            [['title', 'image'], 'string', 'max' => 255]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => \Yii::t('app', 'Id'),
            'status' => \Yii::t('app', 'Статус'),
            'statusLabel' => \Yii::t('app', 'Статус'),
            'title' => \Yii::t('app', 'Название'),
            'image' => \Yii::t('app', 'Изображение'),
            'categoryId' => \Yii::t('app', 'Модельный ряд'),
            'categoryLabel' => \Yii::t('app', 'Модельный ряд'),
            'price' => \Yii::t('app', 'Цена'),
            'url' => \Yii::t('app', 'Ссылка на страницу'),
            'date' => \Yii::t('app', 'Дата выпуска'),
            'created_at' => \Yii::t('app', 'Дата создания'),
            'updated_at' => \Yii::t('app', 'Дата обновления'),
        ];

    }

    public function getFullUrlImage()
    {
        return Url::to(static::PATH_UPLOAD_PHOTO . $this->image);
    }

    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return [
            TimestampBehavior::class,
            'slug' => [
                'class' => Slug::class,
                'in_attribute' => 'title',
                'out_attribute' => 'url',
            ]
        ];
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%car}}';
    }

    public function afterDelete()
    {
        $path = \Yii::getAlias('@frontend/web/' . $this->getFullUrlImage());
        if (file_exists($path)) {
            @unlink($path);
        }
        parent::afterDelete();
    }
}
