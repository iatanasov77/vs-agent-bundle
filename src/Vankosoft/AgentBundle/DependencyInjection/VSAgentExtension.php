<?php namespace Vankosoft\AgentBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\Extension\Extension;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class VSAgentExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load( array $config, ContainerBuilder $container )
    {
        $config = $this->processConfiguration( $this->getConfiguration([], $container), $config );
        
        $loader = new Loader\YamlFileLoader( $container, new FileLocator( __DIR__ . '/../Resources/config' ) );
        $loader->load( 'services.yaml' );
        
        $container->setParameter( 'vs_agent.enabled', $config['enabled'] );
    }
}
