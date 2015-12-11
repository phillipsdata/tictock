<?php
namespace Tictock\Schedule\Adjective;

use Tictock\Schedule\ScheduleInterface;
use Tictock\Schedule\Period\PeriodFactoryInterface;

/**
 * Schedule modifier for every point or every Nth point of a period
 */
class Every
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
     * Schedule every minute
     *
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function minute()
    {
        return $this->schedule->set(
            $this->periodFactory->createMinute()
        );
    }

    /**
     * Schedule every Nth minute
     *
     * @param int $interval
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function minutes($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createMinute($interval, "interval")
        );
    }

    /**
     * Schedule every hour
     *
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function hour()
    {
        return $this->schedule->set(
            $this->periodFactory->createHour()
        );
    }

    /**
     * Schedule every Nth hour
     *
     * @param int $interval
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function hours($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createHour($interval, "interval")
        );
    }

    /**
     * Schedule every day of the month
     *
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function dayOfTheMonth()
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfMonth()
        );
    }

    /**
     * Schedule every Nth day of the month
     *
     * @param int $interval
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function daysOfTheMonth($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfMonth($interval, "interval")
        );
    }

    /**
     * Schedule every month
     *
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function month()
    {
        return $this->schedule->set(
            $this->periodFactory->createMonth()
        );
    }

    /**
     * Schedule every Nth month
     *
     * @param int $interval
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function months($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createMonth($interval, "interval")
        );
    }

    /**
     * Schedule every day of the week
     *
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function dayOfTheWeek()
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfWeek()
        );
    }

    /**
     * Schedule every Nth day of the week
     *
     * @param int $interval
     * @return \Tictock\Schedule\ScheduleInterface The schedule set in the constructor
     */
    public function daysOfTheWeek($interval)
    {
        return $this->schedule->set(
            $this->periodFactory->createDayOfWeek($interval, "interval")
        );
    }
}
