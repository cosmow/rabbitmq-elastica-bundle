<?php

namespace Vadiktok\RabbitMQElasticaBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * Class RabbitMQElasticExtension
 * @package Vadiktok\RabbitMQElastiBundle\DependencyInjection
 */
class VadiktokRabbitMQElasticaExtension extends Extension
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

        if (!$config['producers']) {
            $config['producers'] = ['vadiktok_elastica' => []];
        }

        $container->setParameter('vadiktok_elastica.producers', $config['producers']);

        $container->setParameter('vadiktok_elastica.order', $config['order']);
    }

    /**
     * @return string
     */
    public function getAlias(): string
    {
        return 'vadiktok_rabbit_mq_elastica';
    }
}
