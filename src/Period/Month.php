<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.12.14
 * Time: 18:34
 */

namespace Leaderboard\Period;


class Month extends Period
{

    protected $label = 'month';

    public function getId()
    {
        return $this->date->format('m:Y');
    }
}
