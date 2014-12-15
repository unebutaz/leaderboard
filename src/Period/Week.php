<?php

namespace Leaderboard\Period;

/**
 * Class Week
 * @package Leaderboard\Period
 */
class Week extends Period
{
    /**
     * @var string
     */
    protected $label = "week";

    /**
     * @return string
     */
    public function getId()
    {
        return $this->date->format('W:Y');
    }

    public function __toString()
    {
        return $this->date->format('W')." week of ".$this->date->format('Y');
    }
}
