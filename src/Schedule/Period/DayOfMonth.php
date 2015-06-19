<?php
namespace tictock\Schedule\Period;

use tictock\Schedule\Period\AbstractPeriod;

/**
 * Day of a month Period
 */
class DayOfMonth extends AbstractPeriod
{
    /**
     * {@inheritdoc}
     */
    protected function isValid($val)
    {
        return $val === null || ($val >= 1 && $val <= 31);
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidInterval($val)
    {
        return ($val > 1 && $val < 31);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        return AbstractPeriod::DAYOFMONTH;
    }
}
