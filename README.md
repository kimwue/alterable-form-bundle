Alterable Form Bundle
==============

This bundle lets you alter **existing** Symfony Forms based on yml config values.
If you want to create forms dynamically from yml check out [LinioIT/dynamic-form-bundle](https://github.com/LinioIT/dynamic-form-bundle).

Getting Started
-------
This plugin requires Symfony `^2.8|^3.0`

```JSON
{
    "require": {
        "wuestkamp/alterable-form-bundle": "^0.1.0"
    }
}
```

You need to create your form using the classname like this instead of a name string to be able to use this bundle:

```php
$form = $this->createForm(MyForm::class, $myObject);
```

Usage
-------
Add the bundle to your `AppKernel.php`

```php
new Wuestkamp\AlterableFormBundle\AlterableFormBundle();
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
                    add: false # default is true
        Namespace\Bundle\Form\MyOtherForm:
            fields:
                email:
                    options:
                        attr: {class: 'css_class'}
```

Tests
-------
Git clone this repo then `composer install` and `./vendor/phpunit/phpunit/phpunit -c .`