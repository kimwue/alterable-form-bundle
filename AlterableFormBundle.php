<?php

namespace Wuestkamp\AlterableFormBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;
use Wuestkamp\AlterableFormBundle\DependencyInjection\Compiler\OverrideFormFactoryCompilerPass;

/**
 * AlterableFormBundle.
 *
 * @author Kim Wüstkamp <kim@wuestkamp.com>
 */
class AlterableFormBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideFormFactoryCompilerPass());
    }
}
