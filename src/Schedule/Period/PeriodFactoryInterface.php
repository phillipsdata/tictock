<?php
namespace Tictock\Schedule\Period;

use Tictock\Schedule\Period\PeriodInterface;

interface PeriodFactoryInterface
{
    public function createMinute($val = null, $type = PeriodInterface::TYPE_VALUE);

    public function createHour($val = null, $type = PeriodInterface::TYPE_VALUE);

    public function createDayOfMonth($val = null, $type = PeriodInterface::TYPE_VALUE);

    public function createMonth($val = null, $type = PeriodInterface::TYPE_VALUE);

    public function createDayOfWeek($val = null, $type = PeriodInterface::TYPE_VALUE);
}
