<?php


namespace Application\Console\Command;

use Leaderboard\Leaderboard;
use Leaderboard\Pagination\Pagination;
use Leaderboard\Period\Factory;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class ListScoresCommand extends Command
{
    protected function configure()
    {
        $this
            ->setName('score:list')
            ->setDescription('List all scores')
            ->addOption('period', 'p', InputArgument::OPTIONAL, 'Specify period for leaderboard.', 'year')
            ->addOption('date', 'd', InputArgument::OPTIONAL, 'Date for period.')
            ->addOption('page', 'P', InputArgument::OPTIONAL, 'Page to show', 1);
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $page = (int) $input->getOption('page');

        $storage = $this->getApplication()
            ->getContainer()
            ->get('storage');

        $period = Factory::build($input->getOption('period'), $input->getOption('date'));

        $pagination = new Pagination(
            new Leaderboard($storage, $period)
        );

        if (($page > 1 && $page > count($pagination)) || $page < 1) {
            throw new \OutOfBoundsException("Page number $page doesn't exists.");
        }

        foreach ($pagination->getPage($page) as $player => $score) {
            $output->writeln("$player, {$period}: $score");
        }

        $output->writeln("Page $page of {$pagination->count()}");
    }
}
