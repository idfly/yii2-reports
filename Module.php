<?php

namespace idfly\reports;

class Module extends \yii\base\Module {

    public $controllerNamespace = 'idfly\reports\controllers';

    public function init() {
        parent::init();
        \yii::$app->errorHandler->errorAction = 'reports/reports/error';
    }
}