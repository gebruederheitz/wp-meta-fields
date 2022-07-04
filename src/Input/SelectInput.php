<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class SelectInput extends Input
{
    protected static $templatePath = 'select';

    protected static $templateName = '';

    protected $name = '';

    protected $label = '';

    protected $value = '';

    protected $required = false;

    /**
     * @var array<string, string>
     */
    protected $options = [];

    public function __construct(
        MetaForms $metaForms,
        string $name = '',
        string $label = '',
        $value = '',
        $options = [],
        bool $required = false
    ) {
        $this->setMetaForms($metaForms);
        $this->setName($name);
        $this->setLabel($label);
        $this->setValue($value);
        $this->setOptions($options);
        $this->setRequired($required);
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getLabel(): string
    {
        return $this->label;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    /**
     * @return array<string, string>
     */
    public function getOptions(): array
    {
        return $this->options;
    }

    public function setName(string $name): SelectInput
    {
        $this->name = $name;

        return $this;
    }

    public function setLabel(string $label): SelectInput
    {
        $this->label = __($label, $this->metaForms->getTextDomain());

        return $this;
    }

    public function setValue(string $value): SelectInput
    {
        $this->value = $value;

        return $this;
    }

    public function setRequired(bool $required): SelectInput
    {
        $this->required = $required;

        return $this;
    }

    /**
     * @param array<string, string> $options
     */
    public function setOptions(array $options): SelectInput
    {
        $this->options = $options;

        return $this;
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
