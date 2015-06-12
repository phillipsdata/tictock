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
            $this->schedule->set(new Minute($min));
        }
        return $this->schedule;
    }

    public function hours(array $hours)
    {
        foreach ($hours as $hr) {
            $this->schedule->set(new Hour($hr));
        }
        return $this->schedule;
    }

    public function daysOfTheMonth(array $days)
    {
        foreach ($days as $day) {
            $this->schedule->set(new DayOfMonth($day));
        }
        return $this->schedule;
    }

    public function months(array $months)
    {
        foreach ($months as $month) {
            $this->schedule->set(new Month($month));
        }
        return $this->schedule;
    }

    public function daysOfTheWeek(array $days)
    {
        foreach ($days as $day) {
            $this->schedule->set(new DayOfWeek($day));
        }
        return $this->schedule;
    }
}
