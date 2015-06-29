<?php

namespace idfly\reports\controllers;

use \idfly\reports\models\Report;
use yii\base\Exception;

class ExportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $secret = \Yii::$app->request->get('secret');

        $report = Report::find()->
            where(['secret' => $secret])->one();

        if(empty($report)) {
            throw new \yii\web\HttpException(404);
        }

        $file = $report->getReportFile();

        if(!empty($report->encoding)) {
            iconv("UTF-8", $report->encoding, $file);
        }

        return $file;
    }
}