<?php

namespace Gebruederheitz\Wordpress\MetaFields\Input;

abstract class MinMaxTextInput extends TextInput
{
    /** @var int|string|null */
    protected $minValue;

    /** @var int|string|null */
    protected $maxValue;

    /**
     * @return int|string|null
     */
    public function getMinValue()
    {
        return $this->minValue;
    }

    /**
     * @param int|string|null $minValue
     */
    public function setMinValue($minValue): self
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * @return int|string|null
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * @param int|string|null $maxValue
     */
    public function setMaxValue($maxValue): self
    {
        $this->maxValue = $maxValue;

        return $this;
    }
}
