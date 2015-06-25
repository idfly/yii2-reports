<?php

use yii\helpers\Html;

?>

<?php if(false && \Yii::$app->request->isAjax): ?>
    <?php require $_cardBody ?>
<?php else: ?>
    <section class="panel">
        <div class="panel-heading with-actions clearfix">
            <div class="row" style="margin-left: 0px">
                <h2 class="panel-title inline col-sm-2"><?= Html::encode($_title) ?></h2>

                <div class="action-list inline to-right right col-sm-3">
                    <a class="action btn btn-sm btn-primary" href="<?=
                        Html::encode(\Yii::$app->urlManager->createUrl
                        (['reports/' .
                        $_key . '/update', 'id' => $_element->id])) ?>">Изменить</a>
                </div>
            </div>
        </div>
        <div class="panel-body">
            <?php require $_cardBody ?>
        </div>
    </section>
<?php endif ?>