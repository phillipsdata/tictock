<?php
namespace tictock\Schedule\Period;

interface PeriodInterface
{
    /**
     * Create a Period
     *
     * @param int $val The value to set for the period
     * @param string $type The type of value (value or interval)
     */
    public function __construct($val, $type = "value");

    /**
     * Get the given value
     *
     * return int $val The value to set for the period
     */
    public function get();

    /**
     * Get the value type
     *
     * return int $val The value type (value or interval)
     */
    public function getType();

    /**
     * The period
     *
     * return string one of:
     * - minute
     * - hour
     * - dayofmonth
     * - month
     * - dayofweek
     */
    public function getPeriod();
}
