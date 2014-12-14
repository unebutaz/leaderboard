<?php
/**
 * Created by PhpStorm.
 * User: sergey
 * Date: 14.12.14
 * Time: 2:27
 */

namespace Leaderboard\Period;

abstract class Period
{
    const LABEL = 'period';

    protected $date;

    public function __construct(\DateTime $date = null)
    {
        if (empty($date)) {
            $date = new \DateTime();
        }

        $this->date = $date;
    }

    public function getLabel()
    {
        return self::LABEL;
    }

    abstract public function getId();
}
