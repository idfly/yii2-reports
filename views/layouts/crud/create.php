<?= idfly\porto\Header::get($this) ?>

<?= idfly\porto\Form::getCreateForm([
    'header' => $header,
    'content' => $content,
]) ?>