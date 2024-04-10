<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\DependencyInjection;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;

/**
 * Inject console plugins in commands
 */
class AddConsolePluginPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $commandServices = $container->findTaggedServiceIds('console.command', true);
        $pluginServices = $container->findTaggedServiceIds('console.plugin', true);
        $plugins = [];

        foreach ($pluginServices as $id => $tags) {
            $plugins[] = $container->getDefinition($id);
        }

        foreach ($commandServices as $id => $tags) {
            $definition = $container->getDefinition($id);
            $definition->addMethodCall('setPlugins', [$plugins]);
        }
    }
}
