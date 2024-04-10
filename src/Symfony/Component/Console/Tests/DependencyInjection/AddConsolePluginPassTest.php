<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Tests\DependencyInjection;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\DependencyInjection\AddConsolePluginPass;
use Symfony\Component\DependencyInjection\Compiler\PassConfig;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Definition;

class AddConsolePluginPassTest extends TestCase
{
    public function testProcess()
    {
        $container = new ContainerBuilder();
        $container->addCompilerPass(new AddConsolePluginPass(), PassConfig::TYPE_BEFORE_REMOVING);
        $container->setParameter('my.command.class', 'Symfony\Component\Console\Tests\DependencyInjection\MyCommand');
        $container->setParameter('my.plugin.class', 'Symfony\Component\Console\Tests\DependencyInjection\MyPlugin');

        $commandDefinition = new Definition('%my.command.class%');
        $commandDefinition->addTag('console.command');
        $commandDefinition->setPublic(true);
        $container->setDefinition('my.console.command', $commandDefinition);

        $pluginDefinition = new Definition('%my.plugin.class%');
        $pluginDefinition->addTag('console.plugin');
        $container->setDefinition('my.console.plugin', $pluginDefinition);

        $container->compile();

        $commandDefinition = $container->getDefinition('my.console.command');
        $this->assertTrue($commandDefinition->hasMethodCall('setPlugins'));
    }
}
