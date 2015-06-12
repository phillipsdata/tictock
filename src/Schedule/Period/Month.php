<?php
namespace tictock\Schedule\Period;

/**
 * Month Period
 */
class Month extends AbstractPeriod
{
    /**
     * {@inheritdoc}
     */
    protected function isValid($val)
    {
        return $val === null || ($val >= 1 && $val <= 12);
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidInterval($val)
    {
        return ($val > 1 && $val < 12);
    }
}
