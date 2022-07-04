<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class CheckboxInput extends Input
{
    protected static $templatePath = 'input-field';

    protected static $templateName = 'checkbox';

    protected $name = '';

    protected $label = '';

    protected $checked = false;

    protected $required = false;

    public function __construct(
        MetaForms $metaForms,
        string $name = '',
        string $label = '',
        bool $checked = false,
        bool $required = false
    ) {
        $this->setMetaForms($metaForms);
        $this->setName($name);
        $this->setLabel($label);
        $this->setChecked($checked);
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

    public function isChecked(): string
    {
        return $this->checked;
    }

    public function isRequired(): bool
    {
        return $this->required;
    }

    public function setName(string $name): CheckboxInput
    {
        $this->name = $name;

        return $this;
    }

    public function setLabel(string $label): CheckboxInput
    {
        $this->label = __($label, $this->metaForms->getTextDomain());

        return $this;
    }

    public function setChecked(bool $checked): CheckboxInput
    {
        $this->checked = $checked;

        return $this;
    }

    public function setRequired(bool $required): CheckboxInput
    {
        $this->required = $required;

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
