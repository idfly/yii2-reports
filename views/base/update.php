<?php

use yii\helpers\Html;

?>
<section class="panel">
    <div class="panel-heading with-actions clearfix">
        <h2 class="panel-title inline"><?= Html::encode($_title) ?></h2>
        <div class="action-list inline to-right">
            <a class="action btn btn-sm btn-primary" href="<?= Html::encode(\Yii::$app->
                urlManager->createUrl('reports/' . $_key . '/index')) ?>">Отмена</a>
        </div>
    </div>
    <div class="panel-body">
        <?php require $_updateForm; ?>
    </div>
</section>