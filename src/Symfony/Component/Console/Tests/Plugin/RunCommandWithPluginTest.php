<?php

/*
 * This file is part of the Symfony package.
 *
 * (c) Fabien Potencier <fabien@symfony.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace Symfony\Component\Console\Plugin;

use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Tester\CommandTester;

class RunCommandWithPluginTest extends TestCase
{
    public static function setUpBeforeClass(): void
    {
        require_once __DIR__.'/../Fixtures/WithPluginCommand.php';
        require_once __DIR__.'/../Fixtures/WithPluginAndExistingDefinitionCommand.php';
        require_once __DIR__.'/../Fixtures/Plugin/FooPlugin.php';
    }

    public function testContainsPluginDefinition()
    {
        $command = new \WithPluginCommand();
        $command->addPlugin(new \FooPlugin());
        $command->mergePluginDefinition();

        $this->assertTrue($command->getDefinition()->hasOption('say-hello'));
        $this->assertTrue($command->getDefinition()->hasOption('say-goodbye'));
        $this->assertTrue($command->getDefinition()->hasArgument('username'));
    }

    public function testExecutePluginHooks()
    {
        $command = new \WithPluginCommand();
        $command->addPlugin(new \FooPlugin());

        $commandTester = new CommandTester($command);
        $commandTester->execute([
            'username' => 'John',
            '--say-hello' => true,
            '--say-goodbye' => true,
        ]);

        $commandTester->assertCommandIsSuccessful();

        $output = $commandTester->getDisplay();
        $this->assertStringContainsString('Hello John !', $output);
        $this->assertStringContainsString('Goodbye John !', $output);
    }

    public function testExecutePluginHooksWithExistingCommandDefinition()
    {
        $command = new \WithPluginAndExistingDefinitionCommand();
        $command->addPlugin(new \FooPlugin());
        $command->mergePluginDefinition();

        $this->assertEquals(
            'An option to say hello from the command',
            $command->getDefinition()->getOption('say-hello')->getDescription()
        );
        $this->assertEquals(
            'A person\'s name from the command',
            $command->getDefinition()->getArgument('username')->getDescription()
        );
    }
}
