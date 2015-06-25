<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="en-US" class="fixed">
<head>
    <?= $this->context->renderPartial('/layouts/admin/head.php') ?>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <section class="body-sign">
        <div class="center-sign">
            <?= $content ?>
        </div>
    </section>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>