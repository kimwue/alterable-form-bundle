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

Replace Symfonys FormFactory by setting the following parameter in your config.yml:

```YML
parameters:
    form.factory.class: Wuestkamp\AlterableFormBundle\Component\AlterableFormFactory
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