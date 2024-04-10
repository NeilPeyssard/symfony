<?php

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class WithPluginCommand extends Command
{
    protected function configure(): void
    {
        $this
            ->setName('plugin:command')
        ;
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        return 0;
    }
}
