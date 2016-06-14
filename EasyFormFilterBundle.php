<?php

namespace Ict\FormFilterBundle;

use Ict\FormFilterBundle\DependencyInjection\Compiler\AdaptersPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class EasyFormFilterBundle extends Bundle
{
    /**
     * {@inheritdoc}
     */
    public function build(ContainerBuilder $container)
    {
        $container->addCompilerPass(new AdaptersPass());
    }
}
