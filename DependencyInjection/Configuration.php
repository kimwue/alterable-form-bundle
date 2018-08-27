<?php

namespace Wuestkamp\AlterableFormBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('alterable_form');
        $rootNode
            ->children()
                ->arrayNode('forms')
                    ->useAttributeAsKey('class')
                    ->prototype('array')
                        ->children()
                            ->arrayNode('fields')
                                ->useAttributeAsKey('field')
                                ->prototype('array')
                                    ->children()
                                        ->booleanNode('add')
                                            ->defaultTrue()
                                        ->end()

                                        ->variableNode('options')
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
            ->end();

        return $treeBuilder;
    }
}