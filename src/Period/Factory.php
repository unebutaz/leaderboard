<?php

namespace Leaderboard\Period;

final class Factory
{
    private static $periods = array(
        Day::LABEL  => 'Leaderboard\Period\Day',
        Week::LABEL => 'Leaderboard\Period\Week',
        Year::LABEL => 'Leaderboard\Period\Year'
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
