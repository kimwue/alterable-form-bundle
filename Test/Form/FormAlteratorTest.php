<?php

namespace Wuestkamp\AlterableFormBundle\Test\Form;

use Symfony\Component\Form\FormBuilder;
use Wuestkamp\AlterableFormBundle\Config\ConfigParser;
use Wuestkamp\AlterableFormBundle\Form\FormAlterator;
use Symfony\Component\Yaml\Yaml;
use \Mockery;

class FormAlteratorTest extends \PHPUnit_Framework_TestCase
{
    private function createFormAlteratorMock(array $configuration)
    {
        return new FormAlterator(new ConfigParser($configuration));
    }

    public function testOne()
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

        $configuration = $value = Yaml::parse($yml);

        $formAlterator = $this->createFormAlteratorMock($configuration);

        $formBuilderMock = Mockery::mock(FormBuilder::class);
        $formBuilderMock->shouldReceive('has')->andReturn(true);
        $formBuilderMock->shouldReceive('remove')->andReturn(null);

        $this->assertEquals($formAlterator->alter($formBuilderMock, 'NamespaceOne\BundleOne\Form\UserForm'), $formBuilderMock);
    }

    public function testTwo()
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

        $configuration = $value = Yaml::parse($yml);

        $formAlterator = $this->createFormAlteratorMock($configuration);

        $formBuilderMock = Mockery::mock(FormBuilder::class);

        $this->assertEquals($formAlterator->alter($formBuilderMock, 'NamespaceOne\BundleOne\Form\UserFormd'), $formBuilderMock);
    }

    public function testThree()
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

        $configuration = $value = Yaml::parse($yml);

        $formAlterator = $this->createFormAlteratorMock($configuration);

        $fieldBuilderMock = Mockery::mock(FormBuilder::class);
        $fieldBuilderMock->shouldReceive('getOptions')->andReturn([]);
        $fieldBuilderMock->shouldReceive('getType->getInnerType')->andReturn($fieldBuilderMock);
        $fieldBuilderMock->shouldReceive('getName')->andReturn('testname');

        $formBuilderMock = Mockery::mock(FormBuilder::class);
        $formBuilderMock->shouldReceive('has')->andReturn(true);
        $formBuilderMock->shouldReceive('get')->andReturn($fieldBuilderMock);
        $formBuilderMock->shouldReceive('add')->andReturn($fieldBuilderMock);

        $this->assertEquals($formAlterator->alter($formBuilderMock, 'NamespaceOne\BundleTwo\Form\Form\AddressForm'), $formBuilderMock);
    }
}
