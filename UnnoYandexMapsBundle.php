<?php

namespace Unno\YandexMapsBundle;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

use Unno\YandexMapsBundle\DependencyInjection\Compiler\FormPass;

class UnnoYandexMapsBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new FormPass);
    }
}
