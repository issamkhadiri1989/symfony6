<?php

declare(strict_types=1);

namespace App\Acme\TestBundle\DependencyInjection;

use App\Acme\TestBundle\Service\Acme;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader\YamlFileLoader;

class AcmeTestExtension extends Extension
{
    public function load(array $configs, ContainerBuilder $container)
    {
        $loader = new YamlFileLoader(
            container: $container,
            locator: new FileLocator(paths: __DIR__ . '/../Resources/config')
        );
        $loader->load('services.yaml');
        $configuration = new Configuration();
        $processedConfigs = $this->processConfiguration(configuration: $configuration, configs: $configs);
        $definition = $container->getDefinition(Acme::class);
        $arguments = $definition->getArguments();
        $definition->replaceArgument(0, $processedConfigs['vendors']['facebook']['email']);
//        $definition->replaceArgument('$email', $processedConfigs['vendors']['facebook']['email']);
        $argument = $definition->getArguments();

        /*$this->addAnnotatedClassesToCompile([
            'App\\Controller\\DefaultController',
            '**Bundle\\Controller\\',
        ]);*/
    }
}