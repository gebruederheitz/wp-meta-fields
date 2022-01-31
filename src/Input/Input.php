<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

class Input implements InputInterface
{
    /** @var MetaForms */
    protected $metaForms;

    protected static $templatePath = '';

    protected static $templateName = '';

    public static function make(MetaForms $metaForms): InputInterface
    {
        $class = static::class;
        return new $class($metaForms);
    }

    public function render(): void
    {
        $this->metaForms->render(
            static::$templatePath,
            static::$templateName,
            [$this]
        );
    }

    public function setMetaForms(MetaForms $metaForms): InputInterface
    {
       $this->metaForms = $metaForms;

       return $this;
    }
}
