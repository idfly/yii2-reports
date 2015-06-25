<?php

namespace idfly\reports\controllers;

use app\admin\controllers\BaseController;
use idfly\reports\models\Report;
use yii\base\Exception;

class ReportsController extends BaseController {
    protected $modelClass = '\idfly\reports\models\Report';

    public function actionGetReport()
    {
        $secret = \Yii::$app->request->get('secret');

        $report = Report::find()->
            where(['secret' => $secret])->one();


        if(empty($report)) {
           throw new \yii\web\HttpException(404);
        }

        $args = \Yii::$app->request->get('args');

        try {
            $result =
                \yii::$app->db->createCommand($report->sql, $args)->
                queryAll();
        } catch(Exception $e) {
            throw new \yii\web\HttpException('Failed db query');
        }

        if(empty($result)) {
            throw new \yii\web\HttpException('Empty result\'s db query');
        }

        switch($report->format) {
            case 'csv' :
                self::exportCSV(
                    $report->name,
                    $result,
                    $report->csv_delimiter,
                    $report->csv_enclosure
                ); break;
            case 'xml' : self::exportXML($report->name, $result);
                break;
            case 'json': self::exportJSON($report->name, $result);
                break;
            default:
                throw new \yii\web\HttpException('Report have unknown format');
        }
    }

    public static function exportCSV($filename, $data, $delimiter, $enclosure)
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
        header('Content-Disposition: attachment; filename="' .
            $filename . '.csv"');

        $out = fopen('php://output', 'w');

        fputcsv($out, array_keys($data[0]), $delimiter, $enclosure);

        foreach($data as $dataString) {
            fputcsv($out, $dataString, $delimiter, $enclosure);
        }
        fclose($out);
        exit;
    }

    public static function exportXML($filename, $data)
    {
        $tab = "\t";
        $br = "\n";
        $xml = '<?xml version="1.0" encoding="UTF-8"?>' . $br;

        foreach($data as $dataString) {
            $xml .= '<string>' . $br;
            foreach($dataString as $dataKey => $dataValue) {
                $xml .= $tab . '<' . $dataKey . '>' .
                    htmlspecialchars(stripslashes($dataValue)) .
                    '</' . $dataKey . '>' . $br;
            }
            $xml .= '</string>' . $br;
        }

        header('Content-type: text/xml');
        header('Content-Disposition: attachment; filename="' .
            $filename . '.xml"');

        echo $xml;
        exit;
    }

    public static function exportJSON($filename, $data)
    {
        header('Content-type: text/plain');
        header('Content-Disposition: attachment; filename="' .
            $filename . '.json"');

        echo json_encode($data, JSON_UNESCAPED_UNICODE);
        exit;
    }
}