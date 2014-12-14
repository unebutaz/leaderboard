<?php

namespace Application\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class DecrementScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:decrement')
            ->setDescription("Decrement user score.")
            ->addArgument('user-name', InputArgument::REQUIRED, 'User name.')
            ->addArgument('score', InputArgument::OPTIONAL, 'Decrement value.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');
    }
}
