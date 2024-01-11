<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class TextInput extends Input
{
    protected static $templatePath = 'input-field';

    protected static $templateName = 'text';

    protected $name = '';

    protected $label = '';

    protected $value = '';

    protected $required = false;

    protected $readonly = false;

    protected const type = 'text';

    public function __construct(
        MetaForms $metaForms,
        string $name = '',
        string $label = '',
        $value = '',
        bool $required = false,
        bool $readonly = false
    ) {
        $this->setMetaForms($metaForms);
        $this->setName($name);
        $this->setLabel($label);
        $this->setValue($value);
        $this->setRequired($required);
        $this->setReadonly($readonly);
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getLabel(): string
    {
        return $this->label;
    }

    /**
     * @return string
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * @return bool
     */
    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return self::type;
    }

    /**
     * @param string $name
     *
     * @return TextInput
     */
    public function setName(string $name): TextInput
    {
        $this->name = $name;

        return $this;
    }

    /**
     * @param string $label
     *
     * @return TextInput
     */
    public function setLabel(string $label): TextInput
    {
        $this->label = __($label, $this->metaForms->getTextDomain());

        return $this;
    }

    /**
     * @param string $value
     *
     * @return TextInput
     */
    public function setValue(string $value): TextInput
    {
        $this->value = $value;

        return $this;
    }

    /**
     * @param bool $required
     *
     * @return TextInput
     */
    public function setRequired(bool $required): TextInput
    {
        $this->required = $required;

        return $this;
    }

    public function isReadonly(): bool
    {
        return $this->readonly;
    }

    public function setReadonly(bool $readonly): void
    {
        $this->readonly = $readonly;
    }

    public function render(): void
    {
        if (empty($this->name) || empty($this->label)) {
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
