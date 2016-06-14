<?php

namespace Ict\FormFilterBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\Serializer\Mapping\Loader\XmlFileLoader;

class EasyFormFilterExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new XmlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.xml');

        $configuration = $this->getConfiguration($configs, $container);
        $config = $this->processConfiguration($configuration, $configs);
        
        $container->setParameter('ict_easy_form_filter.current_adapter', $config['adapter']);
        $container->setParameter('ict_easy_form_filter.manage_session_data', $config['manage_session_data']);
    }

}