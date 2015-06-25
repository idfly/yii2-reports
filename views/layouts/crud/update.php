<?= idfly\porto\Header::get($this) ?>

<?= idfly\porto\Form::getUpdateForm([
    'header' => $header,
    'content' => $content,
]) ?>