<?php
    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\CheckboxInput $input */
    [$input] = $args;
?>
<div class="components-panel__row">
    <div class="components-base-control components-checkbox-control">
        <div class="components-base-control__field">
            <span class="components-checkbox-control__input-container">
                <input
                    type="checkbox"
                    name="<?= $input->getName() ?>"
                    id="<?= $input->getName() ?>-input"
                    class="components-checkbox-control__input"<?php
                    if ($input->isChecked()) { echo ' checked'; } ?>
                >
            </span>
            <label
                for="<?= $input->getName() ?>-input"
                class="components-checkbox-control__label"
            >
                <?= $input->getLabel() ?><?php if ($input->isRequired()) echo "*"; ?>
            </label>
        </div>
    </div>
</div>
