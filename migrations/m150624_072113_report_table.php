<?php

use yii\db\Schema;
use yii\db\Migration;

class m150624_072113_report_table extends Migration
{
    public function up()
    {
        $query = 'CREATE TABLE `report` (
            `id` INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
            `name` VARCHAR(128) NOT NULL COMMENT \'название\',
            `secret` VARCHAR(256) NOT NULL COMMENT \'секретный ключ\',
            `active` TINYINT(1) UNSIGNED NOT NULL COMMENT \'активность\',
            `sql` TEXT NOT NULL COMMENT \'sql - запрос\',
            `format` ENUM(\'csv\', \'json\', \'xml\') DEFAULT NULL
              COMMENT \'формат выгрузки отчета\',
            `csv_delimiter` ENUM(\',\', \';\', \'\t\') DEFAULT NULL
              COMMENT \'разделитель для csv формата\',
            `csv_enclosure` ENUM("\'", \'"\', \'NULL\') DEFAULT NULL
               COMMENT \'обёртка для полей csv\',
            PRIMARY KEY(`id`)
        ) COMMENT \'отчёты\'';
        \yii::$app->db->createCommand($query)->execute();
    }

    public function down()
    {
        
    }
}
