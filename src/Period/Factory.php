<?php

namespace Leaderboard\Period;

final class Factory
{
    private static $periods = array(
        'day'   => 'Leaderboard\Period\Day',
        'week'  => 'Leaderboard\Period\Week',
        'month' => 'Leaderboard\Period\Month',
        'year'  => 'Leaderboard\Period\Year',
    );

    public static function getPeriods()
    {
        return self::$periods;
    }

    public static function build($type, \DateTime $date = null)
    {
        if (!in_array($type, array_keys(self::$periods))) {
            throw new \InvalidArgumentException("Given period type ($type) is invalid.");
        }

        $period = self::$periods[$type];

        return new $period($date);
    }
}
