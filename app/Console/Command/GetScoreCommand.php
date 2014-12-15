<?php

namespace Application\Console\Command;

use Leaderboard\PlayerScore;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class GetScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:get')
            ->setDescription("Set specified score for user")
            ->addArgument('user-name', InputArgument::REQUIRED, 'Name of user to retrieve Score for.');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');

        $result = (new PlayerScore($storage))
            ->find($input->getArgument('user-name'));

        foreach ($result as $period => $score) {
            $output->writeln("$period:$score");
        }
    }
}
