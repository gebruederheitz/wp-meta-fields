<?php
    /**
     * Image Picker for non-gutenberg applications where you need to select
     * media from the WP media library.
     * Make sure you have enqueued the wp media scripts.
     */

    /** @var \Gebruederheitz\Wordpress\MetaFields\Input\MediaPicker $input */
    [$input] = $args;
?>

<tr class="form-field term-meta-wrap">
    <th scope="row">
        <?php if ($input->isShowLabel()): ?>
            <label for="upload_image_button">
                <?= esc_html( $input->getLabel() ); ?>
            </label>
        <?php endif; ?>
    </th>
    <td>
        <input id="upload_image_button" type="button" class="button" value="<?= __($input->getButtonText()) ?>" />
        <input type="hidden" name="<?= $input->getIdFieldName() ?>" id="upload_image_id_input" value="<?= $input->getIdFieldValue() ?? null ?>">
        <input type="hidden" name="<?= $input->getUrlFieldName() ?>" id="upload_image_url_input" value="<?= $input->getUrlFieldValue() ?? null ?>">
    </td>
    <?php if (!empty($input->getUrlFieldValue() && $input->isShowPreview())): ?>
        <td>
            <div class='image-preview-wrapper'>
                <img id='image-preview' src='<?= $input->getUrlFieldValue() ?>' height='100' alt="Image upload preview">
            </div>
        </td>
    <?php endif; ?>
</tr>


