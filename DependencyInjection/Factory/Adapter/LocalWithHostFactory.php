<?php

namespace Oneup\FlysystemBundle\DependencyInjection\Factory\Adapter;

use Symfony\Component\Config\Definition\Builder\NodeDefinition;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\DefinitionDecorator;
use Oneup\FlysystemBundle\DependencyInjection\Factory\AdapterFactoryInterface;

class LocalFactory implements AdapterFactoryInterface
{
    public function getKey()
    {
        return 'local_with_host';
    }

    public function create(ContainerBuilder $container, $id, array $config)
    {
        $container
            ->setDefinition($id, new DefinitionDecorator('oneup_flysystem.adapter.local_with_host'))
            ->replaceArgument(0, $config['directory'])
            ->replaceArgument(1, $config['hostname'])
            ->replaceArgument(2, $config['webpath'])
        ;
    }

    public function addConfiguration(NodeDefinition $node)
    {
        $node
            ->children()
                ->scalarNode('directory')->isRequired()->end()
                ->scalarNode('hostname')->isRequired()->end()
                ->scalarNode('webpath')->isRequired()->end()
            ->end()
        ;
    }
}
