<?php

declare(strict_types=1);

namespace Gebruederheitz\Wordpress\MetaFields\Tests;

use Gebruederheitz\Wordpress\MetaFields\Input\MediaPicker;
use Gebruederheitz\Wordpress\MetaFields\Input\TextInput;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;
use PHPUnit\Framework\TestCase;

/**
 * Smoke tests for MetaForms' static factory methods.
 */
class MetaFormsFactoryTest extends TestCase
{
    public function testMakeTextInputFieldReturnsConfiguredTextInput(): void
    {
        $field = MetaForms::makeTextInputField('my_field');

        $this->assertInstanceOf(TextInput::class, $field);
        $this->assertSame('my_field', $field->getName());
    }

    public function testMakeMediaPickerAcceptsNullInputId(): void
    {
        // MediaPicker's $inputId parameter is `?string $inputId = null`
        // (fixed from the implicit-nullable `string $inputId = null`,
        // deprecated as of PHP 8.4). Calling it without an id must not
        // raise a TypeError and should auto-generate one.
        $field = MetaForms::makeMediaPicker(null);

        $this->assertInstanceOf(MediaPicker::class, $field);
        $this->assertNotSame('', $field->getInputId());
    }
}
