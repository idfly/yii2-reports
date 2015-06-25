<?php

use yii\helpers\Html;

?>

<?php if(empty($_filters)) : ?>
    <?php return; ?>
<?php endif; ?>

<?php
    $groups = [];
    foreach($_filters as $filter) {
        if(empty($groups[$filter->group])) {
            $groups[$filter->group] = [];
        }

        $groups[$filter->group][] = $filter;
    }
?>
<div class="filters margin-bottom">
    <?php foreach($groups as $filters): ?>
        <div class="filter-group btn-group" style="margin-bottom: 6px; margin-right: 18px;">
            <?php foreach($filters as $filter): ?>
                <a href="<?= Html::encode($filter->url) ?>&_filter=<?= $filter->id ?>" title="<?=
                    Html::encode($filter->comment) ?>" class="btn btn-xs <?php
                    if(empty($filter->class)): ?>btn-primary<?php else:
                    ?><?= Html::encode($filter->class) ?><?php endif ?> <?
                    if((int)\Yii::$app->request->get('_filter') === $filter->id) { echo 'active'; }
                    ?>"><?= Html::encode($filter->name) ?><?php if($filter->count) {
                        $count = $filter->getCount();
                        if(!empty($count)) {
                             echo ' (' . $count . ')';
                        }
                    } ?></a>
            <?php endforeach ?>
        </div>
    <?php endforeach ?>
</div>