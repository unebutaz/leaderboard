<?php

namespace Application\Console\Command;

use Leaderboard\PlayerScore;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class RemovePlayerCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:remove')
            ->setDescription('Remove player from rating.')
            ->addArgument('user-name', InputArgument::REQUIRED, 'User name');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');

        (new PlayerScore($storage))
            ->remove($input->getArgument('user-name'));
    }
}
