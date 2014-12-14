<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 13.12.14
 * Time: 20:51
 */

namespace Application\Console;

use Symfony\Component\Console\Application as BaseApplication;

class Application extends BaseApplication
{
    protected function getDefaultCommands()
    {
        return array_merge(
            parent::getDefaultCommands(),
            array(
                new Command\SetScoreCommand(),
                new Command\GetScoreCommand(),
                new Command\IncrementScoreCommand(),
                new Command\DecrementScoreCommand(),
            )
        );
    }
}
