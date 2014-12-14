<?php

namespace Application\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:set')
            ->setDescription("Set specified score for user")
            ->addArgument('user-name', InputArgument::REQUIRED, 'Name of user to set Score for.')
            ->addArgument('score', InputArgument::REQUIRED, 'Score value');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');
    }
}
