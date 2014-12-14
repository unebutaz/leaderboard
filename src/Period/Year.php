<?php

namespace Leaderboard\Period;

class Year extends Period
{

    const LABEL = "year";

    public function getId()
    {
        return $this->date->format('Y');
    }
}

