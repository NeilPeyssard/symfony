<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class WithPluginAndExistingDefinitionCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('plugin:with-definition:command')
            ->addOption('say-hello', '-sh', InputOption::VALUE_OPTIONAL, 'An option to say hello from the command')
            ->addArgument('username', InputArgument::OPTIONAL, 'A person\'s name from the command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }
}
