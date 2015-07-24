<?php

namespace idfly\reports\controllers;

use app\admin\controllers\BaseController;
use yii\helpers\Html;

class ReportsController extends BaseController
{
    protected $modelClass = '\idfly\reports\models\Report';
    public $layout = '@app/admin/views/layouts/admin.php';

    protected $titles = [
        'index' => 'Отчеты',
        'update' => 'Редактировать отчет',
        'create' => 'Добавить отчет',
    ];

    public function actionError()
    {
        $this->layout = 'module.php';
        $exception = \Yii::$app->errorHandler->exception;
        echo nl2br(Html::encode($exception->getMessage()));
    }
}
