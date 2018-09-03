Alterable Form Bundle
==============

This bundle lets you alter **existing** Symfony Forms based on yml config values.
If you want to create forms dynamically from yml check out [LinioIT/dynamic-form-bundle](https://github.com/LinioIT/dynamic-form-bundle).

Installation
-------
This plugin requires Symfony `^2.8|^3.0|^4.0`

```JSON
{
    "require": {
        "wuestkamp/alterable-form-bundle": "^0.2"
    }
}
```

**for SF < 4.0**

Add the bundle to your `AppKernel.php`

```php
new Wuestkamp\AlterableFormBundle\AlterableFormBundle();
```

If you are using 2.8 you need to create your forms (which you want to alter) using the classname like this instead of a name string to be able to use this bundle:

```php
$form = $this->createForm(MyForm::class, $myObject);
```

**for SF >= 4.0**

Add this to `config/bundles.php`:
```
\Wuestkamp\AlterableFormBundle\AlterableFormBundle::class => ['all' => true],
```

create file `config/packages/alterable_form.yml`.


Usage
-------
Define yml configuration like this:

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