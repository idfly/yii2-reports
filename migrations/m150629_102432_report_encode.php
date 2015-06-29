<?php

use yii\db\Schema;
use yii\db\Migration;

class m150629_102432_report_encode extends Migration
{
    public function up()
    {
	$query = 'ALTER TABLE `report`
          ADD COLUMN `encoding` VARCHAR(64) NOT NULL,
          MODIFY `csv_delimiter` ENUM(",", ";", "\\t") DEFAULT NULL
              COMMENT "разделитель для csv формата"';
        \yii::$app->db->createCommand($query)->execute();
    }

    public function down()
    {
    
    }
}
