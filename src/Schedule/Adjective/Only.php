<?php
namespace Tictock\Schedule\Adjective;

use Tictock\Schedule\ScheduleInterface;
use Tictock\Schedule\Period\PeriodFactoryInterface;

/**
 * Schedule modifier for only certian points of a period
 */
class Only
{
    /**
     * @var \Tictock\Schedule\ScheduleInterface The schedule
     */
    private $schedule;
    /**
     * @var \Tictock\Schedule\Period\PeriodFactoryInterface  The period factory
     */
    private $periodFactory;

    /**
     * Initialize the modifer
     *
     * @param \Tictock\Schedule\ScheduleInterface $schedule
     * @param \Tictock\Schedule\Period\PeriodFactoryInterface $periodFactory
     */
    public function __construct(ScheduleInterface $schedule, PeriodFactoryInterface $periodFactory)
    {
        $this->schedule = $schedule;
        $this->periodFactory = $periodFactory;
    }

    /**
     * Schedule only these minutes
     *
     * @param array $minutes The minutes to schedule
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function minutes(array $minutes)
    {
        foreach ($minutes as $min) {
            $this->schedule->set(
                $this->periodFactory->createMinute($min)
            );
        }
        return $this->schedule;
    }

    /**
     * Schedule only these hours
     *
     * @param array $hours The hours to schedule
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function hours(array $hours)
    {
        foreach ($hours as $hr) {
            $this->schedule->set(
                $this->periodFactory->createHour($hr)
            );
        }
        return $this->schedule;
    }

    /**
     * Schedule only these days of the month
     *
     * @param array $days The days to schedule
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function daysOfTheMonth(array $days)
    {
        foreach ($days as $day) {
            $this->schedule->set(
                $this->periodFactory->createDayOfMonth($day)
            );
        }
        return $this->schedule;
    }

    /**
     * Schedule only these months
     *
     * @param array $months The months to schedule
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function months(array $months)
    {
        foreach ($months as $month) {
            $this->schedule->set(
                $this->periodFactory->createMonth($month)
            );
        }
        return $this->schedule;
    }

    /**
     * Schedule only these days of the week
     *
     * @param array $days The days to schedule
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
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
