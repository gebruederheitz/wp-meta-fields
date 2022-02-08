<?php

namespace Gebruederheitz\Wordpress\MetaFields;

use Gebruederheitz\SimpleSingleton\Singleton;
use Gebruederheitz\Wordpress\MetaFields\Input\MediaPicker;
use Gebruederheitz\Wordpress\MetaFields\Input\NumberInput;
use Gebruederheitz\Wordpress\MetaFields\Input\TextArea;
use Gebruederheitz\Wordpress\MetaFields\Input\TextInput;

class MetaForms extends Singleton
{
    protected const PAGE_TEMPLATE_PATH = __DIR__ . '/../templates/';

    protected $overridePath = 'template-parts/meta/forms/';

    protected $textDomain = 'ghwp';

    public static function makeMediaPicker(string $name = ''): MediaPicker
    {
        return new MediaPicker(self::getInstance(), $name);
    }

    public static function makeNumberInputField(string $name = ''): NumberInput
    {
        return new NumberInput(self::getInstance(), $name);
    }

    public static function makeTextArea(string $name = ''): TextArea
    {
        return new TextArea(self::getInstance(), $name);
    }

    public static function makeTextInputField(string $name = ''): TextInput
    {
        return new TextInput(self::getInstance(), $name);
    }

    public static function renderMediaPicker(
        string $idFieldName,
        ?int $idFieldValue,
        string $urlFieldName,
        ?string $urlFieldValue,
        string $label = 'Image',
        bool $showLabel = true
    ) {
        self::makeMediaPicker()
            ->setIdFieldName($idFieldName)
            ->setUrlFieldName($urlFieldName)
            ->setLabel($label)
            ->setIdFieldValue($idFieldValue)
            ->setUrlFieldValue($urlFieldValue)
            ->setShowLabel($showLabel)
            ->render();
    }

    public static function renderNumberInputField(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeNumberInputField()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderTextarea(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeTextArea()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderTextInputField(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeTextInputField()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function updateTextDomain(string $textDomain): self
    {
        return self::getInstance()->setTextDomain($textDomain);
    }

    public static function updateOverridePath(string $overridePath): self
    {
        return self::getInstance()->setOverridePath($overridePath);
    }

    public function getTextDomain(): string
    {
        return $this->textDomain;
    }

    public function render(string $path, string $name = '', array $args = null)
    {
        $templatePathUsed = static::PAGE_TEMPLATE_PATH;

        if ($overriddenTemplate = locate_template($this->overridePath)) {
            $templatePathUsed = $overriddenTemplate;
        }

        $template = $templatePathUsed . $path;
        if (!empty($name)) {
            $template .= '-' . $name;
        }
        $template .= '.php';

        load_template($template, false, $args);
    }

    public function setOverridePath(string $path): self
    {
        $this->overridePath = $path;

        return $this;
    }

    public function setTextDomain(string $textDomain): self
    {
        $this->textDomain = $textDomain;

        return $this;
    }
}
