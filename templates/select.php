<?php
    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\SelectInput $input */
    [$input] = $args;
?>
<div class="components-panel__row">
    <div class="components-base-control">
        <div class="components-base-control__field">
            <div class="components-search-control">
                <label
                    for="<?= $input->getName() ?>"
                    class="components-input-control__label"
                >
                    <?= $input->getLabel() ?><?php if ($input->isRequired()) echo "*"; ?>
                </label>
                <div class="components-input-control__container">
                    <select
                        class="components-search-control__input"
                        name="<?= $input->getName() ?>"
                        id="<?= $input->getName() ?>-input"
                    >
                        <?php foreach ($input->getOptions() as $value => $label): ?>
                            <option
                                value="<?= $value ?>"<?php
                                if ($value === $input->getValue()) {echo ' selected';} ?>
                            >
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
            </div>
        </div>
    </div>
</div>
