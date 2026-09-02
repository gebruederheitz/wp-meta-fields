<?php

declare(strict_types=1);

namespace Gebruederheitz\Wordpress\MetaFields\Tests;

use Gebruederheitz\Wordpress\MetaFields\Exception\InvalidFieldConfigurationException;
use Gebruederheitz\Wordpress\MetaFields\MetaForms;
use PHPUnit\Framework\TestCase;

/**
 * Crucial-path smoke tests for field rendering: a field must render markup
 * containing its input id/name, and must refuse to render without a name
 * or label.
 */
class FieldRenderingTest extends TestCase
{
    public function testTextInputRendersMarkupWithNameAndId(): void
    {
        ob_start();
        MetaForms::makeTextInputField('username')
            ->setLabel('Username')
            ->setValue('john')
            ->render();
        $markup = ob_get_clean();

        $this->assertStringContainsString('name="username"', $markup);
        $this->assertStringContainsString('id="username-input"', $markup);
        $this->assertStringContainsString('value="john"', $markup);
    }

    public function testSelectInputRendersOptionMarkup(): void
    {
        ob_start();
        MetaForms::makeSelectField('color')
            ->setLabel('Color')
            ->setOptions(['red' => 'Red', 'blue' => 'Blue'])
            ->setValue('blue')
            ->render();
        $markup = ob_get_clean();

        $this->assertStringContainsString('name="color"', $markup);
        $this->assertStringContainsString('value="red"', $markup);
        $this->assertStringContainsString('Blue', $markup);
    }

    public function testRenderWithoutNameOrLabelThrows(): void
    {
        $this->expectException(InvalidFieldConfigurationException::class);

        MetaForms::makeTextInputField()->render();
    }
}
