<?php

namespace Lucbu\AnsibleWrapperBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration.
 *
 * @link http://symfony.com/doc/current/cookbook/bundles/extension.html
 */
class LucbuAnsibleWrapperExtension extends Extension {
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container) {
        $configuration = new Configuration();

        $config = $this->processConfiguration($configuration, $configs);

        // Create parameters from the configuration
        $alias = $this->getAlias();
        $container->setParameter($alias . '.ansible.user', $config['ansible']['user']);
        $container->setParameter($alias . '.ansible.dir', $config['ansible']['dir']);
        $container->setParameter($alias . '.ansible_playbook.user', $config['ansible_playbook']['user']);
        $container->setParameter($alias . '.ansible_playbook.dir', $config['ansible_playbook']['dir']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('services.yml');
    }

}
