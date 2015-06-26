<?php

use yii\helpers\Html;
$this->title = get_class($exception);
?>
<div class="site-error">

    <h1>Ошибка!</h1>
    <h2><?= Html::encode($this->title) ?></h2>

    <div class="alert alert-danger">
        <?= nl2br(Html::encode($exception->getMessage())) ?>
    </div>

</div>
