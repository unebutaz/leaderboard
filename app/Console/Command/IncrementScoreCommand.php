<?php

namespace Application\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class IncrementScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:increment')
            ->setDescription("Increment user score.")
            ->addArgument('user-name', InputArgument::REQUIRED, 'User name.')
            ->addArgument('increment', InputArgument::OPTIONAL, 'Increment value.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');
    }
}
