import { media, domReady, i18n } from 'wp';

const { __ } = i18n;
const buttonSelector = '[data-gh-image-upload-field="select"]';

class MediaPicker {
    /**
     * @param {Element} button
     */
    constructor(button) {
        this.frame = null;
        this.button = button;
        this.inputId = button.dataset.ghImageUpload;

        this.idInput = document.querySelector(this._selector('id'));
        this.urlInput = document.querySelector(this._selector('url'));
        this.preview = document.querySelector(this._selector('preview'));

        this.onClick = this.onClick.bind(this);
        this.onMediaSelect = this.onMediaSelect.bind(this);
    }

    listen() {
        this.button.addEventListener('click', this.onClick);
    }

    onClick(event) {
        event.preventDefault();

        // Sets up the media library frame
        this.frame = media({
            title: __('Select a file', 'ghwp'),
            button: { text: 'Use this file' },
            multiple: false,
        });

        // Runs when an image is selected.
        this.frame.on('select', this.onMediaSelect);
        this.frame.open();
    }

    onMediaSelect() {
        // Grabs the attachment selection and creates a JSON representation of the model.
        const mediaAttachment = this.frame
            .state()
            .get('selection')
            .first()
            .toJSON();

        // Sends the attachment URL to our custom image input field.
        this.idInput.value = mediaAttachment.id;
        this.urlInput.value = mediaAttachment.url;
        this.preview.src = mediaAttachment.url;
    }

    _selector(type) {
        return `[data-gh-image-upload-field="${type}"][data-gh-image-upload="${this.inputId}"]`;
    }
}

/**
 * Load media uploader on pages with our custom metabox
 */
domReady(() => {
    const mediaUploadButtons = document.querySelectorAll(buttonSelector);
    mediaUploadButtons.forEach((button) => {
        new MediaPicker(button).listen();
    });
});
