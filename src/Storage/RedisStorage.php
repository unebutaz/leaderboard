<?php

namespace Leaderboard\Storage;

use Predis;

/**
 * Class RedisScore
 * @package Score
 */
class RedisStorage implements StorageInterface
{
    const RANGE_COMMAND = 'ZRANGE';
    const INCREMENT_COMMAND = 'ZINCRBY';
    const OPTION_WITHSCORES = 'WITHSCORES';

    /**
     * @var Predis\Client
     */
    private $client;

    /**
     * @param Predis\Client $client
     */
    public function __construct(Predis\Client $client)
    {
        $this->client = $client;
    }

    /**
     * {@inheritdoc}
     */
    public function find($key, $start = 0, $stop = -1)
    {
        if (!is_int($start) || !is_int($stop)) {
            throw new \InvalidArgumentException("Start and Stop parameters must be integer");
        }

        $command = $this->client->createCommand(
            self::RANGE_COMMAND,
            array(
                $key,
                $start,
                $stop,
                self::OPTION_WITHSCORES,
            )
        );

        return $this->client->executeCommand($command);
    }

    /**
     * {@inheritdoc}
     */
    public function findOne($key, $member)
    {
        return (double) $this->client->zscore($key, $member);
    }

    /**
     * {@inheritdoc}
     */
    public function set($key, $member, $score)
    {
        if (!is_numeric($score)) {
            throw new \InvalidArgumentException("Score parameter must be numeric");
        }

        return $this->client->zadd($key, array($member => $score));
    }

    /**
     * {@inheritdoc}
     */
    public function get($key, $member)
    {
        return $this->client->zscore($key, $member);
    }

    /**
     * {@inheritdoc}
     */
    public function increment($key, $member, $increment = 1)
    {
        if (!is_numeric($increment)) {
            throw new \InvalidArgumentException("Second parameter must be numeric");
        }

        $command = $this->client->createCommand(
            self::INCREMENT_COMMAND,
            array(
                $key,
                $increment,
                $member,
            )
        );

        return $this->client->executeCommand($command);
    }

    /**
     * {@inheritdoc}
     */
    public function decrement($key, $member, $decrement = 1)
    {
        $decrement = -abs($decrement);

        return $this->increment($key, $member, $decrement);
    }

    /**
     * {@inheritdoc}
     */
    public function remove($key, $member)
    {
        return (bool) $this->client->zrem($key, $member);
    }

    /**
     * {@inheritdoc}
     */
    public function count($key)
    {
        return $this->client->zcard($key);
    }
}
