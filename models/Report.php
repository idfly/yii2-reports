<?php

namespace idfly\reports\models;

use Yii;

class Report extends \yii\db\ActiveRecord
{

    public static function tableName()
    {
        return 'report';
    }

    public $formats = [
      'csv', 'json', 'xml'
    ];

    public $csvDelimiters = [
        ',', ';', '\\t'
    ];
    public $csvEnclosures = [
        '"', '\'', 'NULL'
    ];

    public function rules()
    {
        return [
            [
                [
                    'name',
                    'secret',
                    'active',
                    'sql',
                    'format',
                    'csv_delimiter',
                    'csv_enclosure',
                ],
                'safe'
            ]
        ];
    }

    public function attributeLabels()
    {
        return [
            'id' => '#',
            'name' => 'Название',
            'secret' => 'Секретный код',
            'active' => 'Активность',
            'sql' => 'SQL - запрос',
            'format' => 'Формат выгрузки отчета',
            'csv_delimiter' => 'Разделитель для csv формата',
            'csv_enclosure' => 'Обёртка для полей csv',
        ];
    }
}