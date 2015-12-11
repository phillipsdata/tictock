<?php
namespace Tictock\Schedule\Period;

use Tictock\Schedule\Period\PeriodInterface;

/**
 * Period Factory Interface
 */
interface PeriodFactoryInterface
{
    /**
     * Create a period representing a minute
     *
     * @param int|null $val
     * @param string $type
     * @return \Tictock\Schedule\Period\PeriodInterface
     */
    public function createMinute($val = null, $type = PeriodInterface::TYPE_VALUE);

    /**
     * Create a period representing a hour
     *
     * @param int|null $val
     * @param string $type
     * @return \Tictock\Schedule\Period\PeriodInterface
     */
    public function createHour($val = null, $type = PeriodInterface::TYPE_VALUE);

    /**
     * Create a period representing a day of the month
     *
     * @param int|null $val
     * @param string $type
     * @return \Tictock\Schedule\Period\PeriodInterface
     */
    public function createDayOfMonth($val = null, $type = PeriodInterface::TYPE_VALUE);

    /**
     * Create a period representing a month
     *
     * @param int|null $val
     * @param string $type
     * @return \Tictock\Schedule\Period\PeriodInterface
     */
    public function createMonth($val = null, $type = PeriodInterface::TYPE_VALUE);

    /**
     * Create a period representing a day of the week
     *
     * @param int|null $val
     * @param string $type
     * @return \Tictock\Schedule\Period\PeriodInterface
     */
    public function createDayOfWeek($val = null, $type = PeriodInterface::TYPE_VALUE);
}
