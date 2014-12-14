<?php

namespace Leaderboard\Storage;

/**
 * Interface StorageInterface
 * @package Leaderboard\Storage
 */
interface StorageInterface
{
    /**
     * Find all values in set, return array of member -> score pairs.
     *
     * @param  string $key
     * @return array
     */
    public function find($key, $start, $stop);

    /**
     * Return score of specified user
     *
     * @param  string $key
     * @param  string $member
     * @return double
     */
    public function findOne($key, $member);

    /**
     * Set score to specified member;
     *
     * @param  string     $key
     * @param  string     $member
     * @param  int|double $score
     * @return mixed
     */
    public function set($key, $member, $score);

    /**
     *  Increments members score by $increment.
     *
     * @param  string     $key
     * @param  string     $member
     * @param  int|double $value
     * @return mixed
     */
    public function increment($key, $member, $value = 1);

    /**
     * Decrements members score by $decrement.
     *
     * @param  string     $key
     * @param  string     $member
     * @param  int|double $value
     * @return mixed
     */
    public function decrement($key, $member, $value = 1);

    /**
     * Remove member from set.
     *
     * @param  string $key
     * @param  string $member
     * @return bool
     */
    public function remove($key, $member);

    /**
     * Return number of members in set.
     *
     * @param  string $key
     * @return int
     */
    public function count($key);
}
