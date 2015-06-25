<?php

use yii\helpers\Html;

?>

<div class="form-horizontal">
    <?php foreach($_element->fields() as $field): ?>
        <div class="form-group">
            <label class="col-sm-3 control-label" for=""><?= Html::encode($_element->getAttributeLabel($field)) ?></label>
            <div class="col-sm-6">
                <div class="form-control"><?= Html::encode($_element->{$field}) ?></div>
            </div>
        </div>
    <?php endforeach ?>
</div>