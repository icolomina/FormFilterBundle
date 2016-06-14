<?php

namespace Ict\FormFilterBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('ict_form_filter_bundle');

        $rootNode
            ->children()
                ->scalarNode('adapter')->defaultValue('orm')->end()
                ->scalarNode('manage_session_data')->defaultTrue()->end()
        ;

    }

}