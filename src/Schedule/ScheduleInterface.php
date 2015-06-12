<?php
namespace tictock\Schedule;

use tictock\Schedule\Period\PeriodInterface;

interface ScheduleInterface
{
    /**
     * @return \tictock\Schedule\Adjective\Only
     */
    public function only();

    /**
     * @return \tictock\Schedule\Adjective\Every
     */
    public function every();

    /**
     * Explicitly set a period
     *
     * @param \tictock\Schedule\Period\PeriodInterface $period
     */
    public function set(PeriodInterface $period);

    /**
     * Fetch periods
     *
     * return array An array of \tictock\Schedule\Period\PeriodInterface
     */
    public function getPeriods();
}
