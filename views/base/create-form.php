<?php $form = idfly\porto\ActiveForm::begin([
    'options' => [
        'class' => $_keyOne . '-form create-form',
    ],
]); ?>

<?php require $_form; ?>

<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <input type="submit" class="btn btn-success" value="Добавить">
    </div>
</div>

<?php idfly\porto\ActiveForm::end(); ?>