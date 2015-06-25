<?php

use yii\helpers\Html;

?>


<div class="header-left">
    <div class="admin-navigation">
        <a href="<?= \Yii::$app->urlManager->createUrl('admin') ?>" class="admin-navigation-link" title="Глагне">Главная</a>
        <div class="admin-navigation-delimeter"></div>
        <a href="<?= \Yii::$app->urlManager->createUrl('admin/supervisor-orders/index') ?>" class="admin-navigation-link">Заказы</a>
        <div class="admin-navigation-delimeter"></div>
        <a href="<?= \Yii::$app->urlManager->createUrl('admin/partners/index') ?>" class="admin-navigation-link">Партнёры</a>
        <div class="admin-navigation-delimeter"></div>
        <a href="<?= \Yii::$app->urlManager->createUrl('admin/clients/index') ?>" class="admin-navigation-link">Клиенты</a>
    </div>
</div>

<div class="header-right">
    <div id="userbox" class="userbox">
        <a href="#" data-toggle="dropdown">
            <i class="fa fa-user"></i>
            <div class="profile-info">
                <?php $user = \app\models\User::getCurrent() ?>
                <span class="name"><?= Html::encode($user->name) ?></span>
                <span class="role"><?= Html::encode($user->group->name) ?></span>
            </div>

            <i class="fa custom-caret"></i>
        </a>

        <div class="dropdown-menu">
            <ul class="list-unstyled">
                <li class="divider"></li>
                <!-- <li>
                    <a role="menuitem" tabindex="-1" href="<?=
                        \Yii::$app->urlManager->createUrl('admin/admins/settings')
                        ?>"><i class="fa fa-gear"></i> Настройки</a>
                </li> -->
                <li>
                    <a role="menuitem" tabindex="-1" href="<?=
                        \Yii::$app->urlManager->createUrl('admin/public/logout')
                        ?>"><i class="fa fa-power-off"></i> Выход</a>
                </li>
            </ul>
        </div>
    </div>
</div>