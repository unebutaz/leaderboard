<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 11.12.14
 * Time: 22:45
 */

namespace Leaderboard\Period;

class Day extends Period
{
    protected $label = "day";

    public function getId()
    {
        return $this->date->format('z:Y');
    }
}
