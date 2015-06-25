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
                <?= $content ?>
            </section>
        </div>
    </section>
    <?php $this->endBody() ?>
    </body>
    </html>
<?php $this->endPage() ?>