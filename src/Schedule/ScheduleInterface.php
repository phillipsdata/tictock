<?php
namespace Tictock\Schedule;

use Tictock\Schedule\Period\PeriodInterface;

interface ScheduleInterface
{
    /**
     * @return \Tictock\Schedule\Adjective\Only
     */
    public function only();

    /**
     * @return \Tictock\Schedule\Adjective\Every
     */
    public function every();

    /**
     * Explicitly set a period
     *
     * @param \Tictock\Schedule\Period\PeriodInterface $period
     */
    public function set(PeriodInterface $period);

    /**
     * Fetch periods
     *
     * return array An array of \Tictock\Schedule\Period\PeriodInterface
     */
    public function getPeriods();

    /**
     * Fetch periods
     *
     * return string The shorthand for schedule: min hour day-of-month month day-of-week
     */
    public function getShorthand();
}
