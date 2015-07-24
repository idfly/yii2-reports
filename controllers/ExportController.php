<?php

namespace idfly\reports\controllers;

use \idfly\reports\models\Report;
use yii\base\Exception;

class ExportController extends \yii\web\Controller
{
    public function actionIndex()
    {
        $secret = \Yii::$app->request->get('secret');

        $report =
            Report::find()->
            where(['secret' => $secret, 'active' => 1])->
            one();

        if(empty($report)) {
            throw new \yii\web\HttpException(404);
        }

        \Yii::$app->response->format = \yii\web\Response::FORMAT_RAW;
        header($report->getHeader());

        return $report->getReport();
    }
}