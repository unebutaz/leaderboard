<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 11.12.14
 * Time: 11:09
 */

namespace Leaderboard\Storage;

use \Predis;

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
     * Returns assoc array of member -> score pairs.
     * Return for specified range.
     *
     * @param  int   $start
     * @param  int   $stop
     * @return mixed
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
                self::OPTION_WITHSCORES
            )
        );

        return $this->client->executeCommand($command);
    }

    /**
     * Finds member score.
     *
     * @param $key
     * @param $member
     * @return string
     */
    public function findOne($key, $member)
    {
        return $this->client->zscore($key, $member);
    }

    /**
     * Set score for specified member.
     * todo: update score if member exists, check redis behaviour
     * @param $member
     * @param $score
     * @return int
     */
    public function set($key, $member, $score)
    {
        if (!is_numeric($score)) {
            throw new \InvalidArgumentException("Score parameter must be numeric");
        }

        return $this->client->zadd($key, array($member => $score));
    }

    /**
     * Increments members score by $increment.
     *
     * @param $member
     * @param  int   $increment
     * @return mixed
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
                $member
            )
        );

        return $this->client->executeCommand($command);
    }

    /**
     * Decrements members rating by
     *
     * @param $member
     * @param  int   $decrement
     * @return mixed
     */
    public function decrement($key, $member, $decrement = 1)
    {
        $decrement = -abs($decrement);

        return $this->increment($member, $decrement);
    }

    /**
     * Removes member from set.
     *
     * @param $member
     * @return int
     */
    public function remove($key, $member)
    {
        return $this->client->zrem($key, $member);
    }
}
