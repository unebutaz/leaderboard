<?php

namespace Leaderboard;

use Leaderboard\Period\Period;
use Leaderboard\Storage\StorageInterface;

/**
 * Class Leaderboard
 *
 * @method array    find($start = 0, $stop = -1)
 * @method string   set($member, $score)
 * @method double   increment($member, $increment = 1)
 * @method double   decrement($member, $decrement = 1)
 * @method bool     remove($member)
 *
 * @package Leaderboard
 */
class Leaderboard implements \IteratorAggregate, \Countable
{

    /**
     * @var StorageInterface
     */
    private $storage;

    /**
     * @var Period
     */
    private $period;

    /**
     * @var string
     */
    private $label;

    /**
     * @return string
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @param string $label
     * @return $this
     */
    public function setLabel($label)
    {
        $this->label = $label;
        return $this;
    }

    /**
     * @param StorageInterface $storage
     * @param Period  $period
     */
    public function __construct(StorageInterface $storage, Period $period = null)
    {
        $this->period  = $period;
        $this->storage = $storage;
        $this->label = 'dummy';
    }

    /**
     * @return StorageInterface
     */
    public function getStorage()
    {
        return $this->storage;
    }

    /**
     * @param  StorageInterface $storage
     * @return $this
     */
    public function setStorage(StorageInterface $storage)
    {
        $this->storage = $storage;

        return $this;
    }

    /**
     * @return Period
     */
    public function getPeriod()
    {
        return $this->period;
    }

    /**
     * @param  Period $period
     * @return $this
     */
    public function setPeriod(Period $period)
    {
        $this->period = $period;

        return $this;
    }

    public function getKey()
    {
        return implode(':', array(
            $this->label,
            $this->period->getLabel(),
            $this->period->getId()
        ));
    }

    public function __call($method, $arguments)
    {
        if (!method_exists($this->storage, $method) && !method_exists($this, $method)) {
            throw new \BadMethodCallException();
        }
        var_dump($arguments);
        array_unshift($arguments, $this->getKey());

        return call_user_func_array(array($this->storage, $method), $arguments);
    }


    public function getIterator()
    {
        return new \ArrayIterator($this->find());
    }

    public function count()
    {
        return $this->storage->count($this->getKey());
    }
}
