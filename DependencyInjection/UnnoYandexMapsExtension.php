<?php

namespace Unno\YandexMapsBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class UnnoYandexMapsExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $container->setParameter('unno_yandex_maps.latitude', $config['latitude']);
        $container->setParameter('unno_yandex_maps.longitude', $config['longitude']);
        $container->setParameter('unno_yandex_maps.canvasZoom', $config['canvasZoom']);

        $container->setParameter('unno_yandex_maps.placemark', $config['placemark']);
        $container->setParameter('unno_yandex_maps.placemark.draggable', $config['placemark']['draggable']);
        $container->setParameter('unno_yandex_maps.placemark.geocoderFunction', $config['placemark']['geocoderFunction']);

        $container->setParameter('unno_yandex_maps.controls.zoom', $config['controls']['zoom']);
        $container->setParameter('unno_yandex_maps.controls.zoomSmall', $config['controls']['zoomSmall']);
        $container->setParameter('unno_yandex_maps.controls.scaleLine', $config['controls']['scaleLine']);
        $container->setParameter('unno_yandex_maps.controls.miniMap', $config['controls']['miniMap']);
        $container->setParameter('unno_yandex_maps.controls.typeSelector', $config['controls']['typeSelector']);
    }

    public function getAlias()
    {
        return 'unno_yandex_maps';
    }
}
