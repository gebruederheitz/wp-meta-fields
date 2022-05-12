<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class MediaPicker extends Input
{
    protected static $templatePath = 'media-picker';

    protected static $templateName = '';

    protected $idFieldName = '';

    protected $idFieldValue;

    protected $urlFieldName = '';

    protected $urlFieldValue;

    protected $label = 'Image';

    protected $showLabel = true;

    public function __construct(
        MetaForms $metaForms,
        string $idFieldName = '',
        string $urlFieldName = '',
        string $label = 'Image',
        ?int $idFieldValue = null,
        ?string $urlFieldValue = null,
        bool $showLabel = true
    ) {
        $this->setMetaForms($metaForms);
        $this->setIdFieldName($idFieldName);
        $this->setUrlFieldName($urlFieldName);
        $this->setLabel($label);
        $this->setIdFieldValue($idFieldValue);
        $this->setUrlFieldValue($urlFieldValue);
        $this->setShowLabel($showLabel);
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
     * @return ?string
     */
    public function getUrlFieldValue(): ?string
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
