<?php

use yii\helpers\Html;
use app\components\NumberHelper;

?>
<table class="table table-condensed mb-none">
    <thead>
    <tr>
        <th>ID</th>
        <th>Название</th>
        <th>Секретный код</th>
        <th>Активность</th>
        <th>SQL - запрос</th>
        <th>Формат выгрузки отчета</th>
        <th>Разделитель для csv формата</th>
        <th>Обёртка для полей csv</th>
        <th></th>
    </tr>
    </thead>

    <?php foreach($reports->getModels() as $report): ?>
        <tr class="report-element" report-id="<?= Html::encode($report->id) ?>">
            <td>
                #<?= Html::encode($report->id) ?>
            </td>
            <td>
                <a target="_blank"
                    href="<?= Html::encode(\Yii::$app->urlManager->createUrl(
                        ['api/reports/' . $report->secret])) ?>">
                    <?= Html::encode($report->name) ?>
                </a>
            </td>
            <td>
                <?= Html::encode($report->secret) ?>
            </td>
            <td>
                <?= Html::encode($report->active) ?>
            </td>
            <td>
                <?= Html::encode($report->sql) ?>
            </td>
            <td>
                <?= Html::encode($report->format) ?>
            </td>
            <td>
                <?= Html::encode($report->csv_delimiter) ?>
            </td>
            <td>
                <?= Html::encode($report->csv_enclosure) ?>
            </td>
            <td>
                <a class="btn btn-xs btn-primary inline fa fa-pencil" href="<?=
                Html::encode(\Yii::$app->urlManager->createUrl(['reports/' .
                    $this->context->id . '/update', 'id' => $report->id])) ?>"></a>
                <a class="btn btn-xs btn-danger inline fa fa-trash-o" href="<?=
                Html::encode(\Yii::$app->urlManager->createUrl(['reports/' .
                    $this->context->id . '/delete', 'id' => $report->id])) ?>"></a>
            </td>
        </tr>
    <?php endforeach ?>
</table>