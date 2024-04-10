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

use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * Interface for command plugins
 */
interface CommandPluginInterface
{
    /**
     * Gets the plugin InputDefinition which will be merged with all commands
     */
    public function getDefinition(): ?InputDefinition;

    /**
     * A method will be applied before running the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function executeBeforeCommand(InputInterface $input, OutputInterface $output): void;

    /**
     * A method will be applied after running the command.
     *
     * @param InputInterface  $input
     * @param OutputInterface $output
     */
    public function executeAfterCommand(InputInterface $input, OutputInterface $output): void;
}

