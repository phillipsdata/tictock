<?php
namespace Tictock\Schedule\Period;

use Tictock\Schedule\Period\PeriodInterface;
use Tictock\Schedule\Period\Minute;
use Tictock\Schedule\Period\Hour;
use Tictock\Schedule\Period\Month;
use Tictock\Schedule\Period\DayOfWeek;
use Tictock\Schedule\Period\DayOfMonth;

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
