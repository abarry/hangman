<?php

namespace Sensio\Bundle\HangmanBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('sensio_hangman');

        $rootNode
        	->children()
        		->scalarNode('word_length')
        			->defaultValue(8)
        		->end()
        		->arrayNode('dictionaries')
        			->isRequired()
        			->requiresAtLeastOneElement()
        			->prototype('scalar')->end()
        		->end()
        	->end();

        return $treeBuilder;
    }
}
