<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US" class="fixed">
<head>
    <?= $this->context->renderPartial('/layouts/admin/head.php') ?>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <section class="body">
        <div class="inner-wrapper">
            <section role="main" class="content-body">
                <?php $user = \app\models\User::getCurrent() ?>
                <?php if(!empty($user)) : ?>
                    <?= idfly\porto\Header::get($this) ?>
                <?php endif ?>
                <?= $content ?>
            </section>
        </div>
    </section>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>