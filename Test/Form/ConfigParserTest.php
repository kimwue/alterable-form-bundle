<?php

namespace Wuestkamp\AlterableFormBundle\Test\Form;

use Wuestkamp\AlterableFormBundle\Config\ConfigParser;
use Symfony\Component\Yaml\Yaml;

class ConfigParserTest extends \PHPUnit_Framework_TestCase
{
    private function createConfigParserMock(array $configuration)
    {
        return new ConfigParser($configuration);
    }

    public function testConfigParserYml()
    {
        $yml = <<<M
forms:
    NamespaceOne\BundleOne\Form\UserForm:
        fields:
            nadme:
                add: false
    NamespaceOne\BundleTwo\Form\Form\AddressForm:
        fields:
            street:
                add: true
                options:
                - required: true
                - attr: {class: 'css_class'}
            streetNumber:
                add: true
M;

        $ymlForms = <<<M
NamespaceOne\BundleOne\Form\UserForm:
    fields:
        nadme:
            add: false
NamespaceOne\BundleTwo\Form\Form\AddressForm:
    fields:
        street:
            add: true
            options:
            - required: true
            - attr: {class: 'css_class'}
        streetNumber:
            add: true
M;

$ymlFormsAddressForm = <<<M
street:
    add: true
    options:
    - required: true
    - attr: {class: 'css_class'}
streetNumber:
    add: true
M;

$ymlFormsAddressFormStreetOptions = <<<M
- required: true
- attr: {class: 'css_class'}
M;

        $configuration = $value = Yaml::parse($yml);
        $configurationForms = $value = Yaml::parse($ymlForms);
        $configurationFormsAddressForm = $value = Yaml::parse($ymlFormsAddressForm);
        $configurationFormsAddressFormStreetOptions = $value = Yaml::parse($ymlFormsAddressFormStreetOptions);

        $configParser = $this->createConfigParserMock($configuration);

        $this->assertEquals($configParser->getForms(), $configurationForms);
        $this->assertEquals($configParser->getFields('NamespaceOne\BundleTwo\Form\Form\AddressForm'), $configurationFormsAddressForm);
        $this->assertEquals($configParser->getFieldConfigOptions('NamespaceOne\BundleTwo\Form\Form\AddressForm', 'street'), $configurationFormsAddressFormStreetOptions);

        $this->assertEquals($configParser->getFields('NamespaceOne\BundleTwo\Form\Form\HelperForm'), null);
        $this->assertEquals($configParser->getFieldConfigOptions('NamespaceOne\BundleTwo\Form\Form\AddressForm', 'i_no_exist'), null);

        $this->assertFalse($configParser->getFieldConfigAdd('NamespaceOne\BundleOne\Form\UserForm', 'name'));
        $this->assertFalse($configParser->getFieldConfigAdd('NamespaceOne\BundleOne\Form\UserForm', 'name_no'));
        $this->assertTrue($configParser->getFieldConfigAdd('NamespaceOne\BundleTwo\Form\Form\AddressForm', 'street'));
        $this->assertTrue($configParser->getFieldConfigAdd('NamespaceOne\BundleTwo\Form\Form\AddressForm', 'streetNumber'));

    }

}
