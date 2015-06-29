<?php

namespace idfly\reports\models;

use Yii;
use yii\base\Exception;

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

    public function generateCSV($data, $delimiter, $enclosure)
    {
        if($delimiter === '\t') {
            $delimiter = chr(9);
        } elseif(empty($delimiter)) {
            $delimiter = ',';
        }

        if($enclosure === 'NULL' || empty($enclosure)) {
            $enclosure = "'";
        }

        header('Content-type: text/plain');

        $out = fopen('php://memory','r+');

        fputcsv($out, array_keys($data[0]), $delimiter, $enclosure);

        foreach($data as $dataString) {
            fputcsv($out, $dataString, $delimiter, $enclosure);
        }

        rewind($out);

        return stream_get_contents($out);
    }

    public function generateXML($data)
    {
        $tab = "\t";
        $br = "\n";
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . $br;
        $xml .= '<elements>' . $br;

        foreach($data as $dataString) {
            $xml .= $tab . '<element>' . $br;
            foreach($dataString as $dataKey => $dataValue) {
                $xml .= $tab . $tab . '<' . $dataKey . '>' .
                    htmlspecialchars(stripslashes($dataValue)) .
                    '</' . $dataKey . '>' . $br;
            }
            $xml .= $tab . '</element>' . $br;
        }

        $xml .= '</elements>' . $br;

        header('Content-type: text/xml');

        return $xml;
    }

    public function generateJSON($data)
    {
        header('Content-type: text/plain');

        return json_encode($data, JSON_UNESCAPED_UNICODE);
    }

    public function getReportFile()
    {
        $args = \Yii::$app->request->get('args');

        try {
            $result =
                \yii::$app->db->createCommand($this->sql, $args)->
                queryAll();
        } catch(Exception $e) {
            throw new \yii\web\HttpException(400,
                $e->getMessage() . PHP_EOL .
                'Параметры из GET-запроса: ' . print_r($args, true)
            );
        }

        if(empty($result)) {
            throw new \yii\web\HttpException(400, 'Empty result\'s db query');
        }

        switch($this->format) {
            case 'csv' :
                $file = $this->generateCSV(
                    $result,
                    $this->csv_delimiter,
                    $this->csv_enclosure
                ); break;
            case 'xml' :
                $file = $this->generateXML($result);
                break;
            case 'json':
                $file = $this->generateJSON($result);
                break;
            default:
                throw new \yii\web\HttpException(400,
                    'Report have unknown format');
        }

        return $file;
    }
}