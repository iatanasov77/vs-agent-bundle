<?php namespace Vankosoft\AgentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

class VSAgentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load( array $config, ContainerBuilder $container ): void
    {
        $config = $this->processConfiguration( $this->getConfiguration([], $container), $config );
        
        $loader = new Loader\YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yaml' );
        
        $container->setParameter( 'vs_agent.enabled', $config['enabled'] );
    }
}
