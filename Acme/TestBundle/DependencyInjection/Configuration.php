<?php

declare(strict_types=1);

namespace App\Acme\TestBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('acme_test');
        $treeBuilder->getRootNode()
            ->children()
            ->arrayNode('vendors')
                ->isRequired()
                ->requiresAtLeastOneElement()
                ->useAttributeAsKey('name')
                ->arrayPrototype()
                ->children()
                    ->scalarNode('email')
                ->end()
            ->end();

        return $treeBuilder;
    }
}