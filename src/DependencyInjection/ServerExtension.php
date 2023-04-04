<?php


namespace A4Sex\ServerBundle\DependencyInjection;


use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

class ServerExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../../config'));
        $loader->load('services.yml');

        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

//        $definition = $container->getDefinition('A4Sex\Services\JWTManager');
//        $definition->replaceArgument('$token_ttl', $config['access_ttl']);
//
//        $definition = $container->getDefinition('refresh_token.generator');
//        $definition->setProperty('tokenLifetime', $config['refresh_ttl']);
    }
}
