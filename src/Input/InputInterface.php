<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

use Gebruederheitz\Wordpress\MetaFields\MetaForms;

interface InputInterface
{
    public static function make(MetaForms $metaForms): self;

    public function render(): void;

    public function setMetaForms(MetaForms $metaForms): self;
}
