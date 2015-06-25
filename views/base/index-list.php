<?php

use yii\helpers\Html;
?>

<?php
    $elements = $_elements->getModels();
    $first = null;
    if(!empty($elements)) {
        $first = $elements[0];
    }
?>
<div class="<?= $_key ?>-list">
    <?php if(empty($first)) : ?>
        <p>Список пуст</p>
    <?php else: ?>
        <table class="table table-condensed mb-none">
            <thead>
                <tr>
                    <th>ID</th>
                    <?php foreach($first->fields() as $field): ?>
                        <?php if($field === 'id'): ?>
                            <?php continue; ?>
                        <?php endif ?>
                        <th><?= Html::encode($first->getAttributeLabel($field)) ?></th>
                    <?php endforeach ?>
                    <th></th>
                </tr>
            </thead>
            <tbody>

            <?php foreach($elements as $element): ?>
                <tr class="list-element <?= Html::encode($_keyOne) ?>-element" <?=
                    Html::encode($_keyOne) ?>-id="<?= Html::encode($element->id) ?>">

                    <td>#<?= Html::encode($element->id) ?></td>
                    <?php foreach($element->fields() as $field): ?>
                        <?php if($field === 'id'): ?>
                            <?php continue; ?>
                        <?php endif ?>
                        <td class="<?= Html::encode($_keyOne) ?>-<?= Html::encode($field)
                            ?>"><?= Html::encode($element->{$field}) ?></td>
                    <?php endforeach ?>

                    <td>
                        <a class="btn btn-xs btn-primary inline fa fa-pencil" href="<?=
                            Html::encode(\Yii::$app->urlManager->createUrl
                            (['reports/' .
                            $this->context->id . '/update', 'id' => $element->id]))
                            ?>"></a>
                        <a class="btn btn-xs btn-danger inline fa fa-trash-o" href="<?=
                            Html::encode(\Yii::$app->urlManager->createUrl(['reports/' .
                            $this->context->id . '/delete', 'id' => $element->id]))
                            ?>"></a>
                    </td>

                </tr>
            <?php endforeach ?>
            </tbody>
        </table>
    <?php endif ?>
</div>
