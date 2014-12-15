<?php

namespace Leaderboard\Period;

/**
 * Class Day
 * @package Leaderboard\Period
 */
class Day extends Period
{
    /**
     * @var string
     */
    protected $label = "day";

    /**
     * @return string
     */
    public function getId()
    {
        return $this->date->format('z:Y');
    }

    public function __toString()
    {
        return $this->date->format('Y-m-d');
    }
}
