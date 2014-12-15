<?php

namespace Leaderboard\Period;

/**
 * Class Factory
 * @package Leaderboard\Period
 */
final class Factory
{
    /**
     * @var array
     */
    private static $periods = array(
        'day'   => 'Leaderboard\Period\Day',
        'week'  => 'Leaderboard\Period\Week',
        'month' => 'Leaderboard\Period\Month',
        'year'  => 'Leaderboard\Period\Year',
    );

    /**
     * @return array
     */
    public static function getPeriods()
    {
        return self::$periods;
    }

    /**
     * @param $type
     * @param  \DateTime $date
     * @return mixed
     */
    public static function build($type, $date = null)
    {
        if (!in_array($type, array_keys(self::$periods))) {
            throw new \InvalidArgumentException("Given period type ($type) is invalid.");
        }

        if (!$date instanceof \DateTime) {
            $date = new \DateTime($date);
        }

        $period = self::$periods[$type];

        return new $period($date);
    }
}
