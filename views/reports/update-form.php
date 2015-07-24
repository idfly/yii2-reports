<?php $form = idfly\porto\ActiveForm::begin(); ?>
<?php
$action = 'update';
require 'form.php';
?>
<div class="row">
    <div class="col-sm-3 col-sm-offset-3">
        <input type="submit" class="btn btn-success" value="Сохранить">
    </div>
</div>

<?php idfly\porto\ActiveForm::end() ;?>