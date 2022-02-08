# Wordpress Meta Fields

_Dependency-less helpers for a faster Wordpress metaboxes setup._

---

## Installation

via composer:
```shell
> composer require gebruederheitz/wp-meta-fields
```

Make sure you have Composer autoload or an alternative class loader present.

## Usage

Use these helpers anywhere in the WP administration backend where you want to
render "metaboxes", or input fields for editors. 

WP-Meta-Fields comes with no frontend dependencies – no extra stylesheets or
client-side scripts that could cause trouble with installation. This also means,
however, that it doesn't come with fancy features like asnyc search, validation
or fancy styles for the various input types. It merely provides an intuitive
interface to create DRY code when creating metaboxes.


```php
use Gebruederheitz\Wordpress\MetaFields\MetaForms;

function render($value) 
{
    // Use the "render{$type}" static methods:
    MetaForms::renderTextInputField('ghwp_favourite_color', $value, 'Favourite color');
    // ...or the more verbose "make{$type}" methods, which support chaining:
    MetaForms::makeTextInputField()
        ->setName('ghwp_favourite_food')
        ->setValue($value)
        ->setLabel('Your favourite food')
        ->render();
}
```


### Label i18n

Labels are automatically translated using Wordpress' `__()` internationalisation
function. By default, the namespace "ghwp" is applied. To customize this text
domain, call one of the setter method on the singleton:

```php
MetaForms::updateTextDomain('my-textdomain');
// or
MetaForms::getInstance()->setTextDomain('my-textdomain');
```


### Inputs API

All field require at least one name attribute (as noted for each type below) to
be set, otherwise an `InvalidFieldConfigurationException` will be thrown.

#### TextInput

For rendering a regular text input field.

##### `MetaForms::renderTextInputField(string $name, string $label, $value = '', bool $required = false)`

| Parameter | Type | Description |
| --- | --- | --- |
| name | string | Identifier for the field. You will use this value to read the $_POSTed data back from the form. Required. |
| label | string | A short description for the site editor about the field's expected content. [Auto-translated](#label-i18n). Required. |
| value | ?string | The current value of this field. Will be escaped with Wordpress' own `esc_attr()`. Default `''` (empty string). |
| required | boolean | Whether to mark the field as required. An asterisk will be appended to the label and the `<input>` element will have a `required` attribute set. Default `false`. |


#### NumberInput

For rendering a an `<input type="number" />`.

##### `MetaForms::renderNumberInputField()`

same as [TextInput](#metaformsrendertextinputfieldstring-name-string-label-value---bool-required--false)


#### TextArea

Renders a `<textarea>`.

##### `MetaForms::renderTextArea()`

same as [TextInput](#metaformsrendertextinputfieldstring-name-string-label-value---bool-required--false)


#### MediaPicker

Renders the inputs required for a Wordpress media picker, with a preview of the
currently selected medium.

For this to work, make sure the WP media scripts are enqueued. If you're using
[`gebruederheitz/wp-easy-cpt`](https://packagist.org/packages/gebruederheitz/wp-easy-cpt)
this is easily achieved by setting `protected $withMedia = true;` on your
`PostType` implementation. Otherwise you will need to add a callback to the 
appropriate action hook:

```php
class UsesMetaForms
{
    public function __construct() 
    {
        add_action('admin_enqueue_scripts', [$this, 'onAdminEnqueueScripts']);
    }
    
    public function onAdminEnqueueScripts()
    {
        wp_enqueue_media();
    }
}
```

##### `MetaForms::renderMediaPicker()`

| Parameter | Type | Description |
| --- | --- | --- |
| idFieldName | string | Identifier for the field, storing the attachment ID of the selected media. You will use this value to read the $_POSTed data back from the form. Required. |
| idFieldValue | ?int | Attachment ID of the selected media. |
| urlFieldName | Identifier for the field, storing the public URL for the selected media. You will use this value to read the $_POSTed data back from the form. Required. |
| urlFieldValue | ?string | Public URL of the selected media. |
| label | string | Text content of the associated `<label>` element. Default `'Image'`. |
| showLabel | boolean | Whether to display the label or not. Default `true`. |


### Using custom templates

You can override the default templates provided by simply putting a template
file with the correct name into `template-parts/meta/forms/` within your theme's
root directory:

| Input type | Template name |
| --- | --- |
| Text / Default | `input-field-text.php` |
| Number | `input-field-text.php` |
| Textarea | `textarea.php` |
| Media picker | `media-picker.php` |


#### Customizing the template override location

If you want to use a custom location (other than `template-parts/meta/forms/`)
you can provide your own override base path using one of the singleton's setter
methods. You can not change the names of the template files.

```php
// Make sure to end with a trailing slash
MetaForms::updateOverridePath('partials/vendor/gebruederheitz/meta-forms/override/')
// or
MetaForms::getInstance()->setOverridePath('partials/vendor/gebruederheitz/meta-forms/override/');
```


## Development

### Dependencies

- PHP >= 7.4
- [Composer 2.x](https://getcomposer.org)
- [NVM](https://github.com/nvm-sh/nvm) and nodeJS LTS (v16.x)
- Nice to have: GNU Make (or drop-in alternative)

