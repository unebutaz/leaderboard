<?php

namespace Leaderboard\Period;

/**
 * Class Year
 * @package Leaderboard\Period
 */
class Year extends Period
{
    /**
     * @var string
     */
    protected $label = "year";

    /**
     * @return string
     */
    public function getId()
    {
        return $this->date->format('Y');
    }

    public function __toString()
    {
        return 'Year ' . $this->date->format('Y');
    }
}
