<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 11.12.14
 * Time: 22:48
 */

namespace Leaderboard\Period;

class Week extends Period
{
    const LABEL = "week";

    public function getId()
    {
        return $this->date->format('W:Y');
    }
}
