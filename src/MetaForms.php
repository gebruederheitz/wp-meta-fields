<?php

namespace Gebruederheitz\Wordpress\MetaFields;

use Gebruederheitz\SimpleSingleton\Singleton;
use Gebruederheitz\Wordpress\MetaFields\Input\CheckboxInput;
use Gebruederheitz\Wordpress\MetaFields\Input\DateInput;
use Gebruederheitz\Wordpress\MetaFields\Input\DateTimeInput;
use Gebruederheitz\Wordpress\MetaFields\Input\MediaPicker;
use Gebruederheitz\Wordpress\MetaFields\Input\NumberInput;
use Gebruederheitz\Wordpress\MetaFields\Input\SelectInput;
use Gebruederheitz\Wordpress\MetaFields\Input\TextArea;
use Gebruederheitz\Wordpress\MetaFields\Input\TextInput;
use Gebruederheitz\Wordpress\MetaFields\Input\TimeInput;

class MetaForms extends Singleton
{
    protected const PAGE_TEMPLATE_PATH = __DIR__ . '/../templates/';

    protected $overridePath = 'template-parts/meta/forms/';

    protected $textDomain = 'ghwp';

    protected $hasRenderedCheckboxStyles = false;

    public static function makeCheckboxField(string $name = ''): CheckboxInput
    {
        $instance = self::getInstance();
        $instance->maybeRenderCheckboxStyles();
        return new CheckboxInput($instance, $name);
    }

    public static function makeDateInputField(string $name = ''): DateInput
    {
        return new DateInput(self::getInstance(), $name);
    }

    public static function makeDateTimeInputField(
        string $name = ''
    ): DateTimeInput {
        return new DateTimeInput(self::getInstance(), $name);
    }

    public static function makeMediaPicker(string $inputId = null): MediaPicker
    {
        return new MediaPicker(self::getInstance(), $inputId);
    }

    public static function makeNumberInputField(string $name = ''): NumberInput
    {
        return new NumberInput(self::getInstance(), $name);
    }

    public static function makeSelectField(string $name = ''): SelectInput
    {
        return new SelectInput(self::getInstance(), $name);
    }

    public static function makeTextArea(string $name = ''): TextArea
    {
        return new TextArea(self::getInstance(), $name);
    }

    public static function makeTextInputField(string $name = ''): TextInput
    {
        return new TextInput(self::getInstance(), $name);
    }

    public static function makeTimeInputField(string $name = ''): TimeInput
    {
        return new TimeInput(self::getInstance(), $name);
    }

    public static function renderMediaPicker(
        string $idFieldName,
        ?int $idFieldValue,
        string $urlFieldName,
        ?string $urlFieldValue,
        string $inputId = null,
        string $label = 'Image',
        bool $showLabel = true
    ) {
        self::makeMediaPicker($inputId)
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

    public static function renderDateInputField(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeDateInputField()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderDateTimeInputField(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeDateTimeInputField()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderTimeInputField(
        string $name,
        $value,
        string $label,
        bool $required = false
    ) {
        self::makeTimeInputField()
            ->setName($name)
            ->setValue($value)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderCheckboxField(
        string $name,
        bool $checked,
        string $label,
        bool $required = false
    ) {
        self::makeCheckboxField()
            ->setName($name)
            ->setChecked($checked)
            ->setLabel($label)
            ->setRequired($required)
            ->render();
    }

    public static function renderSelectField(
        string $name,
        string $value,
        string $label,
        array $options,
        bool $required = false
    ) {
        self::makeSelectField()
            ->setName($name)
            ->setValue($value)
            ->setOptions($options)
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

    protected function __construct()
    {
        parent::__construct();
        MediaUploadScripts::registerScripts();
    }

    public function getTextDomain(): string
    {
        return $this->textDomain;
    }

    public function render(string $path, string $name = '', array $args = null)
    {
        $templatePath = $path;
        if (!empty($name)) {
            $templatePath .= '-' . $name;
        }
        $templatePath .= '.php';

        if ($overriddenTemplate = locate_template($this->overridePath . $templatePath)) {
            $template = $overriddenTemplate;
        } else {
            $template = static::PAGE_TEMPLATE_PATH . $templatePath;
        }

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

    protected function maybeRenderCheckboxStyles(): void
    {
        if (!$this->hasRenderedCheckboxStyles) {
            $this->hasRenderedCheckboxStyles = true;

            $templatePathUsed = static::PAGE_TEMPLATE_PATH;
            if ($overriddenTemplate = locate_template($this->overridePath)) {
                $templatePathUsed = $overriddenTemplate;
            }

            $template = $templatePathUsed . 'style-checkbox.php';
            load_template($template, false);
        }
    }
}
