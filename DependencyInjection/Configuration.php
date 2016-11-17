<?php

namespace Lucbu\AnsibleWrapperBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\NodeBuilder;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * Class Configuration
 * @package Lucbu\AnsibleWrapperBundle\DependencyInjection
 */
class Configuration implements ConfigurationInterface {

    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder() {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('lucbu_ansible_wrapper');

        $rootNode->addDefaultsIfNotSet();
        $children = $rootNode->children();

        $this->setConfig($children);

        return $treeBuilder;
    }

    /**
     * Build configuration
     * @param NodeBuilder $rootNode
     */
    protected function setConfig(NodeBuilder $rootNode) {
        $ansibleNode = $rootNode->arrayNode('ansible')->children();
        $ansibleNode->scalarNode('user')->defaultValue(null);
        $ansibleNode->scalarNode('dir')->defaultValue(null);

        $ansiblePlaybookNode = $rootNode->arrayNode('ansible_playbook')->children();
        $ansiblePlaybookNode->scalarNode('user')->defaultValue(null);
        $ansiblePlaybookNode->scalarNode('dir')->defaultValue(null);
    }
}
