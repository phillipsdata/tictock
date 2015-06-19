<?php
namespace tictock\Schedule\Adjective;

use tictock\Schedule\ScheduleInterface;
use tictock\Schedule\Period\PeriodFactoryInterface;

class Only
{
    private $schedule;
    private $periodFactory;

    public function __construct(ScheduleInterface $schedule, PeriodFactoryInterface $periodFactory)
    {
        $this->schedule = $schedule;
        $this->periodFactory = $periodFactory;
    }

    public function minutes(array $minutes)
    {
        foreach ($minutes as $min) {
            $this->schedule->set(
                $this->periodFactory->createMinute($min)
            );
        }
        return $this->schedule;
    }

    public function hours(array $hours)
    {
        foreach ($hours as $hr) {
            $this->schedule->set(
                $this->periodFactory->createHour($hr)
            );
        }
        return $this->schedule;
    }

    public function daysOfTheMonth(array $days)
    {
        foreach ($days as $day) {
            $this->schedule->set(
                $this->periodFactory->createDayOfMonth($day)
            );
        }
        return $this->schedule;
    }

    public function months(array $months)
    {
        foreach ($months as $month) {
            $this->schedule->set(
                $this->periodFactory->createMonth($month)
            );
        }
        return $this->schedule;
    }

    public function daysOfTheWeek(array $days)
    {
        foreach ($days as $day) {
            $this->schedule->set(
                $this->periodFactory->createDayOfWeek($day)
            );
        }
        return $this->schedule;
    }
}
