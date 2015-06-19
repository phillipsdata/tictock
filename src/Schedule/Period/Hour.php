<?php
namespace tictock\Schedule\Period;

use tictock\Schedule\Period\AbstractPeriod;

/**
 * Hour Period
 */
class Hour extends AbstractPeriod
{
    /**
     * {@inheritdoc}
     */
    protected function isValid($val)
    {
        return $val === null || ($val >= 0 && $val < 24);
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidInterval($val)
    {
        return ($val > 1 && $val < 24);
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        return AbstractPeriod::HOUR;
    }
}
