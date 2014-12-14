<?php

namespace Application\Console\Command;

use Leaderboard\PlayerScore;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class SetScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:set')
            ->setDescription("Set score for player")
            ->addArgument('user-name', InputArgument::REQUIRED, 'User name or id')
            ->addArgument('score', InputArgument::REQUIRED, 'Score value');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');

        $name  = $input->getArgument('user-name');
        $score = $input->getArgument('score');

        (new PlayerScore($storage))->set($input->getArgument('user-name'), $score);
    }
}
