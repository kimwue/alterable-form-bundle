<?php

namespace Wuestkamp\AlterableFormBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;
use Wuestkamp\AlterableFormBundle\Form\FormFactory;

class OverrideFormFactoryCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $definition = $container->getDefinition('form.factory');
        $definition->setClass(FormFactory::class);
        $definition->addArgument(new Reference('alterable_form.form_alterator'));
    }
}
