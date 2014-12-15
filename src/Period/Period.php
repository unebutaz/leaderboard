<?php

namespace Leaderboard\Period;

/**
 * Class Period
 * @package Leaderboard\Period
 */
abstract class Period
{
    /**
     * @var
     */
    protected $label;

    /**
     * @var \Datetime
     */
    protected $date;

    /**
     * @param \DateTime $date
     */
    public function __construct(\DateTime $date = null)
    {
        if (empty($date)) {
            $date = new \DateTime();
        }

        $this->date = $date;
    }

    /**
     * @return mixed
     */
    public function getLabel()
    {
        return $this->label;
    }

    /**
     * @return mixed
     */
    abstract public function getId();

    /**
     * @return string
     */
    abstract public function __toString();
}
