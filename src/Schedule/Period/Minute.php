<?php
namespace Tictock\Schedule\Period;

use Tictock\Schedule\Period\AbstractPeriod;

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

    /**
     * {@inheritdoc}
     */
    public function getPeriod()
    {
        return AbstractPeriod::MINUTE;
    }
}
