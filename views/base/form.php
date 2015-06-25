<?php $inputs = $this->context->fieldsInputs($form, $_element); ?>

<?php foreach(array_keys($_element->getAttributes()) as $field): ?>
    <?php if($field === 'id'): ?>
        <?php continue; ?>
    <?php endif ?>

    <?php if(!empty($inputs[$field])) : ?>
        <?= $inputs[$field] ?>
    <?php else: ?>
        <?=$form->field($_element, $field)->input('text') ?>
    <?php endif ?>

<?php endforeach ?>