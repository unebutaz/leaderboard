<?php

namespace Application\Console;

use Symfony\Component\Console\Application as BaseApplication;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Application extends BaseApplication implements ContainerAwareInterface
{
    protected $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function getContainer()
    {
        return $this->container;
    }

    protected function getDefaultCommands()
    {
        return array_merge(
            parent::getDefaultCommands(),
            array(
                new Command\ListScoresCommand(),
                new Command\GetScoreCommand(),
                new Command\SetScoreCommand(),
                new Command\IncrementScoreCommand(),
                new Command\DecrementScoreCommand(),
                new Command\RemovePlayerCommand(),
            )
        );
    }
}
