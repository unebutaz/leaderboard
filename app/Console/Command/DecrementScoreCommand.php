<?php

namespace Application\Console\Command;

use Leaderboard\PlayerScore;
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
            ->addArgument('decrement', InputArgument::OPTIONAL, 'Decrement value.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');

        $decrement = !empty($input->getArgument('decrement'))
            ? $input->getArgument('decrement')
            : 1;

        (new PlayerScore($storage))->increment(
            $input->getArgument('user-name'),
            $decrement
        );
    }
}
