<?php

use yii\helpers\Html;

?>

<?php
    echo yii\widgets\LinkPager::widget([
        'pagination' => $_elements->getPagination(),
    ]);
?>

<input type="hidden" class="list-query" value="<?=
    Html::encode($_SERVER['QUERY_STRING']) ?>">