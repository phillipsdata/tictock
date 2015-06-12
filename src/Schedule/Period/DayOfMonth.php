<?php
namespace tictock\Schedule\Period;

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
}
