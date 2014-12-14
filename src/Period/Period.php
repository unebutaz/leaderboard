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
    protected $label;

    /**
     * @var \Datetime
     */
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
        return $this->label;
    }


    abstract public function getId();


    public function __toString()
    {
        return $this->label . ":" . $this->getId();
    }
}
