<?php
namespace tictock\Schedule\Period;

use tictock\Schedule\Period\Minute;
use tictock\Schedule\Period\Hour;
use tictock\Schedule\Period\Month;
use tictock\Schedule\Period\DayOfWeek;
use tictock\Schedule\Period\DayOfMonth;

class PeriodFactory implements PeriodFactoryInterface
{
    public function createMinute($val = null, $type = "value")
    {
        return new Minute($val, $type);
    }

    public function createHour($val = null, $type = "value")
    {
        return new Hour($val, $type);
    }

    public function createDayOfMonth($val = null, $type = "value")
    {
        return new DayOfMonth($val, $type);
    }

    public function createMonth($val = null, $type = "value")
    {
        return new Month($val, $type);
    }

    public function createDayOfWeek($val = null, $type = "value")
    {
        return new DayOfWeek($val, $type);
    }
}
