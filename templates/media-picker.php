<?php
    /**
     * Image Picker for non-gutenberg applications where you need to select
     * media from the WP media library.
     * Make sure you have enqueued the wp media scripts.
     */

    use function esc_html;

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
        <input
            data-gh-image-upload="<?= $input->getInputId() ?>"
            data-gh-image-upload-field="select"
            type="button"
            class="button"
            value="<?= __( 'Select image' ) ?>"
        />
        <input
            type="hidden"
            name="<?= $input->getIdFieldName() ?>"
            data-gh-image-upload-field="id"
            data-gh-image-upload="<?= $input->getInputId() ?>"
            value="<?= $input->getIdFieldValue() ?? null ?>"
        >
        <input
            type="hidden"
            name="<?= $input->getUrlFieldName() ?>"
            data-gh-image-upload-field="url"
            data-gh-image-upload="<?= $input->getInputId() ?>"
            value="<?= $input->getUrlFieldValue() ?? null ?>"
        >
    </td>
    <?php if (!empty($input->getUrlFieldValue())): ?>
        <td>
            <div class='image-preview-wrapper'>
                <img
                    data-gh-image-upload-field="preview"
                    data-gh-image-upload="<?= $input->getInputId() ?>"
                    src='<?= $input->getUrlFieldValue() ?>'
                    height='100'
                    alt="Image upload preview"
                >
            </div>
        </td>
    <?php endif; ?>
</tr>


