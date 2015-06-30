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

        header($report->getHeader());
        $report = $report->getReport();

        return $report;
    }
}