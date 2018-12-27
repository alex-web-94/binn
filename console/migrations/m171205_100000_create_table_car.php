<?php

class m171205_100000_create_table_car extends yii\db\Migration
{
    const TABLE_CAR = '{{%car}}';

    public function safeUp()
    {

        if (Yii::$app->db->schema->getTableSchema(self::TABLE_CAR, true) === null) {
            $this->createTable(self::TABLE_CAR, [
                'id' => $this->primaryKey()->unsigned()->comment('Id'),
                'status' => $this->smallInteger(2)->comment('Статус'),
                'categoryId' => $this->smallInteger(3)->comment('id модельного ряда'),
                'title' => $this->string(255)->comment('Название'),
                'image' => $this->string(255)->comment('Изображение'),
                'price' => $this->integer(11)->comment('Цена'),
                'url' => $this->string(255)->comment('ссылка на страницу'),
                'date' => $this->integer(11)->comment('дата выпуска в формате timestump'),
                'created_at' => $this->integer(11)->notNull()->comment('дата создания'),
                'updated_at' => $this->integer(11)->notNull()->comment('дата обновления'),

            ], 'ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT="Автомобили"');

            $this->createIndex('url', self::TABLE_CAR, 'url', true);

        }

        Yii::$app->db->schema->refresh();
    }

    public function safeDown()
    {
        $this->dropTable(self::TABLE_CAR);
        Yii::$app->db->schema->refresh();
    }
}
