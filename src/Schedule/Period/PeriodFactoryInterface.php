<?php
namespace tictock\Schedule\Period;

interface PeriodFactoryInterface
{
    public function createMinute($val = null, $type = "value");

    public function createHour($val = null, $type = "value");

    public function createDayOfMonth($val = null, $type = "value");

    public function createMonth($val = null, $type = "value");

    public function createDayOfWeek($val = null, $type = "value");
}
