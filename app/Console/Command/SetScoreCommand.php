<?php

namespace Application\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Leaderboard\Storage\RedisStorage;
use Predis\Client as PredisClient;

class SetScoreCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:add')
            ->setDescription("Add specified score for user")
            ->addArgument('name', InputArgument::REQUIRED, 'Name of user to set Score for.')
            ->addArgument('score', InputArgument::REQUIRED, 'Score value');
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $name  = $input->getArgument('name');
        $score = $input->getArgument('score');

        try {
            $scores = new RedisStorage(new PredisClient());
            $scores->set('set', $name, $score);
        } catch (\Exception $e) {
            $output->write($e->getMessage());
        }

        $output->writeln('addScore command '.$name.' '.$score);
    }
}
