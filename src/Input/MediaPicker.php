<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MediaUploadScripts;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class MediaPicker extends Input
{
    protected static $templatePath = 'media-picker';

    protected static $templateName = '';

    /** @var string */
    protected $inputId = '';

    /** @var string */
    protected $idFieldName = '';

    /** @var ?int */
    protected $idFieldValue;

    /** @var string */
    protected $urlFieldName = '';

    /** @var string */
    protected $urlFieldValue = '';

    /** @var string */
    protected $label = 'Image';

    /** @var bool */
    protected $showLabel = true;

    /** @var string */
    protected $buttonText = 'Select image';

    /** @var bool $showPreview */
    protected $showPreview = true;

    public function __construct(
        MetaForms $metaForms,
        string $inputId = null,
        string $idFieldName = '',
        string $urlFieldName = '',
        string $label = 'Image',
        ?int $idFieldValue = null,
        ?string $urlFieldValue = '',
        bool $showLabel = true
    ) {
        MediaUploadScripts::enqueueScripts();
        if ($inputId === null) {
            $inputId = random_bytes(16);
        }
        $this->setInputId($inputId);
        $this->setMetaForms($metaForms);
        $this->setIdFieldName($idFieldName);
        $this->setUrlFieldName($urlFieldName);
        $this->setLabel($label);
        $this->setIdFieldValue($idFieldValue);
        $this->setUrlFieldValue($urlFieldValue);
        $this->setShowLabel($showLabel);
    }

    public function getInputId(): string
    {
        return $this->inputId;
    }

    public function setInputId(string $inputId): self
    {
        $this->inputId = $inputId;

        return $this;
    }

    /**
     * @return string
     */
    public function getIdFieldName(): string
    {
        return $this->idFieldName;
    }

    /**
     * @param string $idFieldName
     *
     * @return MediaPicker
     */
    public function setIdFieldName(string $idFieldName): self
    {
        $this->idFieldName = $idFieldName;

        return $this;
    }

    /**
     * @return ?int
     */
    public function getIdFieldValue(): ?int
    {
        return $this->idFieldValue;
    }

    /**
     * @param ?int $idFieldValue
     *
     * @return MediaPicker
     */
    public function setIdFieldValue(?int $idFieldValue): self
    {
        $this->idFieldValue = $idFieldValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrlFieldName(): string
    {
        return $this->urlFieldName;
    }

    /**
     * @param string $urlFieldName
     *
     * @return MediaPicker
     */
    public function setUrlFieldName(string $urlFieldName): self
    {
        $this->urlFieldName = $urlFieldName;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrlFieldValue(): string
    {
        return $this->urlFieldValue;
    }

    /**
     * @param string $urlFieldValue
     *
     * @return self
     */
    public function setUrlFieldValue(string $urlFieldValue): self
    {
        $this->urlFieldValue = $urlFieldValue;

        return $this;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @param string $label
     *
     * @return MediaPicker
     */
    public function setLabel(string $label): self
    {
        $this->label = __($label, $this->metaForms->getTextDomain());

        return $this;
    }

    /**
     * @return bool
     */
    public function isShowLabel(): bool
    {
        return $this->showLabel;
    }

    /**
     * @param bool $showLabel
     *
     * @return MediaPicker
     */
    public function setShowLabel(bool $showLabel): self
    {
        $this->showLabel = $showLabel;

        return $this;
    }

    public function getButtonText(): string
    {
        return $this->buttonText;
    }

    public function setButtonText(string $buttonText): self
    {
        $this->buttonText = $buttonText;

        return $this;
    }

    public function isShowPreview(): bool
    {
        return $this->showPreview;
    }

    public function setShowPreview(bool $showPreview): self
    {
        $this->showPreview = $showPreview;

        return $this;
    }

    public function render(): void
    {
        if (
            empty($this->idFieldName) ||
            empty($this->urlFieldName) ||
            empty($this->label)
        ) {
            error_log(
                'Error: The render method on this field was called without a name or label set.',
            );
            throw new InvalidFieldConfigurationException(
                'Every fields needs to have a name and a label.',
            );
        }

        parent::render();
    }
}
