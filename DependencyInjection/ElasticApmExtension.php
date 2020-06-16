<?php

namespace FP\ElasticApmBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class ElasticApmExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__.'/../Resources/config'));
        $loader->load('services.yml');

        $elasticApmAgentServiceDefinition = $container->getDefinition('elastic_apm.service.agent');
        $elasticApmAgentServiceDefinition->replaceArgument(0, $config);

        $requestListenerDefinition = $container->getDefinition('elastic_apm.listener.request');
        if ($transactionConfig = $config['transactions']) {
            if ($transactionConfig['exclude']) {
                $requestListenerDefinition->addMethodCall('setExclude', [$transactionConfig['exclude']]);
            }
        }
    }
}
