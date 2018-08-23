Alterable Form Bunde
==============

This bundle lets you alter existing Symfony Forms based on yml config values.

Getting Started
-------
This plugin requires Symfony `^2.8|^3.0`

```JSON
{
    "require": {
        "wuestkamp/alterable-form-bundle": "dev-master"
    }
}
```

You need to create your form using the classname like this:

```php
$form = $this->createForm(MyForm::class, $myObject);
```

Then you can define yml configuration like this:

```YML
alterable_form:
    Namespace\Bundle\Form\MyForm:
        field_name:
            options:
                required: false
```

Tests
-------
coming... O:)

Usage
-------
Add the bundle to your `AppKernel.php`

```php
new Wuestkamp\AlterableFormBundle\AlterableFormBundle();
```

Create yml configuration for existing forms.