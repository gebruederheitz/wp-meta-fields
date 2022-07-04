<?php
    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\TextArea $input */
    [$input] = $args;
?>
<div class="components-panel__row">
    <div class="components-base-control">
        <div class="components-base-control__field">
            <label for="<?= $input->getName() ?>" class="components-base-control__label"><?= $input->getLabel() ?><?php if ($input->isRequired()) echo "*"; ?></label>
            <textarea name="<?= $input->getName() ?>" class="components-text-control__input"<?php if ($input->isRequired()) echo ' required'; ?>><?= esc_html($input->getValue()) ?></textarea>
        </div>
    </div>
</div>
