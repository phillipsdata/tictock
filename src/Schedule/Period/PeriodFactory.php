<?php
namespace tictock\Schedule\Period;

use tictock\Schedule\Period\PeriodInterface;
use tictock\Schedule\Period\Minute;
use tictock\Schedule\Period\Hour;
use tictock\Schedule\Period\Month;
use tictock\Schedule\Period\DayOfWeek;
use tictock\Schedule\Period\DayOfMonth;

class PeriodFactory implements PeriodFactoryInterface
{
    /**
     * {@inheritdoc}
     */
    public function createMinute($val = null, $type = PeriodInterface::TYPE_VALUE)
    {
        return new Minute($val, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function createHour($val = null, $type = PeriodInterface::TYPE_VALUE)
    {
        return new Hour($val, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function createDayOfMonth($val = null, $type = PeriodInterface::TYPE_VALUE)
    {
        return new DayOfMonth($val, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function createMonth($val = null, $type = PeriodInterface::TYPE_VALUE)
    {
        return new Month($val, $type);
    }

    /**
     * {@inheritdoc}
     */
    public function createDayOfWeek($val = null, $type = PeriodInterface::TYPE_VALUE)
    {
        return new DayOfWeek($val, $type);
    }
}
