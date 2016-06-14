<?php

namespace Ict\FormFilterBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

/**
 * Class AdaptersPass loads adapters on adapters collection
 * @package EasyFormFilterBundle\DependencyInjection\Compiler
 */
class AdaptersPass implements CompilerPassInterface
{
    /**
     * {@inheritdoc}
     */
    public function process(ContainerBuilder $container)
    {
        $adaptersColDefinition = $container->getDefinition('ict_form_filter_bundle.adapters_collection');
        $taggedAdapters = $container->findTaggedServiceIds('ict_form_filter_bundle.adapter');

        foreach ($taggedAdapters as $id => $tags) {
            $adaptersColDefinition->addMethodCall('setAdapter', array($tags[0]['alias'], new Reference($id)));
        }
    }
}