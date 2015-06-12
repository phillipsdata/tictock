<?php
namespace tictock\Schedule\Adjective;

use tictock\Schedule\ScheduleInterface;
use tictock\Schedule\Period\PeriodFactoryInterface;

class Every
{
    private $schedule;
    private $periodFactory;

    public function __construct(ScheduleInterface $schedule, PeriodFactoryInterface $periodFactory)
    {
        $this->schedule = $schedule;
        $this->periodFactory = $periodFactory;
    }

    public function minute()
    {
        return $this->schedule->set(
            $this->periodFactory->createMinute()
        );
    }

    public function minutes($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createMinute($interval, "interval")
        );
    }

    public function hour()
    {
        return $this->schedule->set(
            $this->periodFactory->createHour()
        );
    }

    public function hours($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createHour($interval, "interval")
        );
    }

    public function dayOfTheMonth()
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfMonth()
        );
    }

    public function daysOfTheMonth($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfMonth($interval, "interval")
        );
    }

    public function month()
    {
        return $this->schedule->set(
            $this->periodFactory->createMonth()
        );
    }

    public function months($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createMonth($interval, "interval")
        );
    }

    public function dayOfTheWeek()
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfWeek()
        );
    }

    public function daysOfTheWeek($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfWeek($interval, "interval")
        );
    }
}
