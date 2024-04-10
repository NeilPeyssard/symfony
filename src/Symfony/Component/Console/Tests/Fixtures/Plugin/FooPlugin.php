<?php

use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputDefinition;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Plugin\CommandPluginInterface;

class FooPlugin implements CommandPluginInterface
{
    public function getDefinition(): ?InputDefinition
    {
        return new InputDefinition([
            new InputOption('say-hello', '-sh', InputOption::VALUE_OPTIONAL, 'An option to say hello'),
            new InputOption('say-goodbye', '-sg', InputOption::VALUE_OPTIONAL, 'An option to say goodbye'),
            new InputArgument('username', InputArgument::OPTIONAL, 'A person\'s name'),
        ]);
    }

    public function executeBeforeCommand(InputInterface $input, OutputInterface $output): void
    {
        if (!$input->hasOption('say-hello') || !$input->getOption('say-hello')) {
            return;
        }

        if ($input->hasArgument('username') && $input->getArgument('username')) {
            $output->writeln(sprintf('Hello %s !', $input->getArgument('username')));

            return;
        }

        $output->writeln('Hello !');
    }

    public function executeAfterCommand(InputInterface $input, OutputInterface $output): void
    {
        if (!$input->hasOption('say-goodbye') || !$input->getOption('say-goodbye')) {
            return;
        }

        if ($input->hasArgument('username') && $input->getArgument('username')) {
            $output->writeln(sprintf('Goodbye %s !', $input->getArgument('username')));

            return;
        }

        $output->writeln('Goodbye !');
    }
}
