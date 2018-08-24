Alterable Form Bunde
==============

This bundle lets you alter **existing** Symfony Forms based on yml config values.
If you want to create forms dynamically from yml check out [LinioIT/dynamic-form-bundle](https://github.com/LinioIT/dynamic-form-bundle).

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

You need to create your form using the classname like this instead of a name string:

```php
$form = $this->createForm(MyForm::class, $myObject);
```

Then you can define yml configuration like this:

```YML
alterable_form:
    forms:
        Namespace\Bundle\Form\MyForm:
            fields:
                first_name:
                    options:
                        required: false
                last_name:
                    remove: true
                email:
                    options:
                        attr: {class: 'css_class'}
```

Tests
-------
coming soon... O:)

Usage
-------
Add the bundle to your `AppKernel.php`

```php
new Wuestkamp\AlterableFormBundle\AlterableFormBundle();
```

Create yml configuration for existing forms.