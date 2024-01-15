<?php
    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\TextInput $input */
    [$input] = $args;
?>
<div class="components-panel__row">
    <div class="components-base-control">
        <div class="components-base-control__field">
            <label
                for="<?= $input->getName() ?>-input"
                class="components-base-control__label"
            >
                <?= $input->getLabel() ?><?php if ($input->isRequired()) echo "*"; ?>
            </label>
            <input
                type="<?= $input->getType() ?>"
                name="<?= $input->getName() ?>"
                id="<?= $input->getName() ?>-input"
                class="components-text-control__input"
                value="<?= esc_attr($input->getValue()) ?>"<?php if ($input->isRequired()) echo ' required'; ?>
                <?php if (method_exists($input, 'getMinValue') && !empty($input->getMinValue())): ?>
                min="<?= $input->getMinValue() ?>"
                <?php endif; ?>
                <?php if (method_exists($input, 'getMaxValue') && !empty($input->getMaxValue())): ?>
                max="<?= $input->getMaxValue() ?>"
                <?php endif; ?>
                <?php if (!empty($input->getPlaceholder())): ?>
                placeholder="<?= $input->getPlaceholder() ?>"
                <?php endif; ?><?php
                    if ($input->isReadonly()) { echo " readonly"; }
                ?>
            >
        </div>
    </div>
</div>
