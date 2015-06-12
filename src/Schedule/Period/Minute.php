<?php
namespace tictock\Schedule\Period;

/**
 * Minute Period
 */
class Minute extends AbstractPeriod
{
    /**
     * {@inheritdoc}
     */
    protected function isValid($val)
    {
        return $val === null || ($val >= 0 && $val < 60);
    }

    /**
     * {@inheritdoc}
     */
    protected function isValidInterval($val)
    {
        return ($val > 1 && $val < 60);
    }
}
