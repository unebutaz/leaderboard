<?php

namespace Leaderboard\Period;

/**
 * Class Month
 * @package Leaderboard\Period
 */
class Month extends Period
{
    /**
     * @var string
     */
    protected $label = 'month';


    /**
     * @return string
     */
    public function getId()
    {
        return $this->date->format('m:Y');
    }

    public function __toString()
    {
        return $this->date->format('M Y');
    }
}
