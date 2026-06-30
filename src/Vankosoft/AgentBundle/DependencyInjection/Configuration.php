<?php namespace Vankosoft\AgentBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder    = new TreeBuilder( 'vs_agent' );
        $rootNode       = $treeBuilder->getRootNode();

        $rootNode
            ->children()
                ->booleanNode( 'enabled' )->defaultValue( true )->end()
            ->end()
        ;
        
        return $treeBuilder;
    }
}
