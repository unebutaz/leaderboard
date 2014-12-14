<?php

namespace Leaderboard;

use Leaderboard\Period\Factory as PeriodFactory;
use Leaderboard\Storage\StorageInterface;

/**
 * Class PlayerScore
 *
 * @method set($member, $score)
 * @method increment($member, $increment = 1)
 * @method decrement($member, $decrement = 1)
 * @method remove($member)
 *
 * @package Leaderboard
 */
class PlayerScore
{
    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var
     */
    private $player;

    /**
     * @return mixed
     */
    public function getPlayer()
    {
        return $this->player;
    }

    /**
     * @param  mixed $player
     * @return $this
     */
    public function setPlayer($player)
    {
        $this->player = $player;

        return $this;
    }

    /**
     * @param StorageInterface $storage
     */
    public function __construct(StorageInterface $storage)
    {
        $this->storage = $storage;
    }

    /**
     * @param $method
     * @param $arguments
     * @return array
     */
    public function __call($method, $arguments)
    {
        if (!method_exists($this->storage, $method) && !method_exists($this, $method)) {
            throw new \BadMethodCallException();
        }

        $result = array();

        foreach (PeriodFactory::getPeriods() as $type => $period) {
            $board = new Leaderboard(
                $this->storage,
                PeriodFactory::build($type)
            );

            $result[$type] = call_user_func_array(array($board, $method), $arguments);
        }

        return $result;
    }

    /**
     * @param string $member
     * @return double
     */
    public function find($member)
    {
        return $this->findOne($member);
    }
}
