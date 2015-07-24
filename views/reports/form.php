<?php

use yii\helpers\Html;

?>

<?= $form->
field($report, 'name')->
input('text', ['class' => 'form-control col-sm-6']) ?>

<?= $form->
field($report, 'secret')->
input('text', ['class' => 'form-control col-sm-6']) ?>

<?= $form->field($report, 'sql')->textarea() ?>

<div class="form-group">
    <label class="col-sm-3 control-label">Формат</label>
    <div class="col-sm-6">
        <select class="form-control" name="Report[format]">
            <option></option>
            <?php foreach($report->formats as $format) : ?>
                <option value="<?= $format ?>"
                    <?php if($report->format == $format) : ?>
                        selected="selected"
                    <?php endif ?>
                    ><?= $format ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Разделитель для полей CSV</label>
    <div class="col-sm-6">
        <select class="form-control" name="Report[csv_delimiter]">
            <option></option>
            <?php foreach($report->csvDelimiters as $delimiter) : ?>
                <option value="<?= $delimiter ?>"
                    <?php if($report->csv_delimiter == $delimiter) : ?>
                        selected="selected"
                    <?php endif ?>
                    ><?= $delimiter ?></option>
            <?php endforeach ?>
        </select>
    </div>
</div>

<div class="form-group">
    <label class="col-sm-3 control-label">Обёртка для полей CSV</label>
    <div class="col-sm-6">
        <select class="form-control" name="Report[csv_enclosure]">
            <option></option>
            <?php foreach($report->csvEnclosures as $enclosure) : ?>
                <?php if($enclosure == '"') : ?>
                    <option value='<?= $enclosure ?>'
                        <?php if($report->csv_enclosure == $enclosure) : ?>
                            selected="selected"
                        <?php endif ?>
                        ><?= $enclosure ?></option>
                <?php else : ?>
                    <option value="<?= $enclosure ?>"
                        <?php if($report->csv_enclosure == $enclosure) : ?>
                            selected="selected"
                        <?php endif ?>
                        ><?= $enclosure ?></option>
                <?php endif ?>

            <?php endforeach ?>
        </select>
    </div>
</div>

<?= $form->
field($report, 'encoding')->
input('text', ['class' => 'form-control col-sm-6']) ?>

<?= $form->field($report, 'active')->checkbox() ?>


