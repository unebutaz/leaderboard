<?php

namespace Leaderboard\Period;

class Year extends Period
{
    protected $label = "year";

    public function getId()
    {
        return $this->date->format('Y');
    }
}
