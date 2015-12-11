<?php
namespace Tictock\Schedule\Period;

use Tictock\Schedule\Period\AbstractPeriod;

/**
 * Day of a week Period
 */
class DayOfWeek extends AbstractPeriod
{
    /**
     * {@inheritdoc}
     */
    protected function isValid($val)
    {
        return $val === null || ($val >= 0 && $val <= 6);
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidInterval($val)
    {
        return ($val > 1 && $val < 6);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        return AbstractPeriod::DAYOFWEEK;
    }
}
