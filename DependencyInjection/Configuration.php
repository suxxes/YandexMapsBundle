<?php

namespace Unno\YandexMapsBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('unno_yandex_maps');

        // Here you should define the parameters that are allowed to
        // configure your bundle. See the documentation linked above for
        // more information on that topic.
        $rootNode
            ->children()
                ->scalarNode('package')->defaultValue('package.standard')->end()
                ->floatNode('latitude')->defaultValue(37.619899)->end()
                ->floatNode('longitude')->defaultValue(55.753676)->end()
                ->integerNode('canvasZoom')->defaultValue(10)->end()
                ->arrayNode('placemark')
                    ->canBeEnabled()
                    ->children()
                        ->booleanNode('enabled')->defaultValue(false)->end()
                        ->booleanNode('draggable')->defaultValue(false)->end()
                        ->scalarNode('geocoderFunction')->defaultValue('yandexMapsGeocoder')->end()
                    ->end()
                ->end()
                ->arrayNode('controls')
                    ->children()
                        ->booleanNode('zoom')->defaultValue(true)->end()
                        ->booleanNode('zoomSmall')->defaultValue(false)->end()
                        ->booleanNode('scaleLine')->defaultValue(false)->end()
                        ->booleanNode('miniMap')->defaultValue(false)->end()
                        ->booleanNode('typeSelector')->defaultValue(false)->end()
                    ->end()
                ->end()
                ->arrayNode('behaviors')
                    ->prototype('scalar')
                ->end()
            ->end();

        return $treeBuilder;
    }
}
