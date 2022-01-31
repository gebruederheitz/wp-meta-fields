<?php
    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\TextInput $input */
    [$input] = $args;
?>
<div class="components-base-control">
    <div class="components-base-control__field">
        <label for="<?= $input->getName() ?>" class="components-base-control__label"><?= $input->getLabel() ?><?php if ($input->isRequired()) echo "*"; ?></label>
        <input type="<?= $input->getType() ?>" name="<?= $input->getName() ?>" class="components-text-control__input" value="<?= esc_attr($input->getValue()) ?>"<?php if ($input->isRequired()) echo ' required'; ?>>
    </div>
</div>
