<?php
namespace Tictock\Scheduler\Platform;

use Tictock\Scheduler\SchedulerInterface;
use Tictock\Schedule\ScheduleInterface;
use Tictock\Schedule\Period\PeriodInterface;

/**
 * Windows task scheduler
 */
class Windows implements SchedulerInterface
{
    private $output = array();
    private $name = null;
    const COMMAND = 'schtasks';

    /**
     * Initialize
     *
     * @param string $name The name of the scheduled task
     */
    public function __construct($name = null)
    {
        $this->name = $name;
    }

    /**
     * {@inheritdoc}
     */
    public function save(ScheduleInterface $schedule, $cmd)
    {
        $name = $this->name
            ? $this->name
            : '"' . substr(str_replace('"', '', $cmd), -32) . '"';

        $task = self::COMMAND .
            ' /create ' . $this->getScheduleCommand($schedule)
            . ' /tn ' . $name
            . ' /tr ' . $cmd;

        $output = array();
        $return = 0;

        exec($task, $output, $return);
        $this->output = $output;
        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function output()
    {
        return $this->output;
    }

    /**
     * Builds the schedule command
     *
     * @param ScheduleInterface $schedule
     * @return string
     */
    private function getScheduleCommand(ScheduleInterface $schedule)
    {
        $periods = $this->formatPeriods($schedule->getPeriods());
        $type = $this->scheduleType($periods);

        $flags = array('/sc' => $type);
        $interval = null;

        switch ($type) {
            case 'MINUTE':
                $interval = $this->getInterval($periods['minute']);
                break;
            case 'HOURLY':
                $interval = $this->getInterval($periods['hour']);
                break;
            case 'DAILY':
                $interval = $this->getInterval($periods['dayofmonth']);
                break;
            case 'WEEKLY':
                $interval = $this->getInterval($periods['dayofweek']);

                $days = $this->getDaysOfWeek($periods['dayofweek']);
                if ($days) {
                    $flags['/d'] = $days;
                }
                break;
            case 'MONTHLY':
                $interval = $this->getInterval($periods['month']);

                if ($interval) {
                    $days = $this->getDaysOfMonth($periods['dayofmonth']);
                    if ($days) {
                        $flags['/d'] = $days;
                    }
                } else {
                    $days = $this->getDaysOfWeek($periods['dayofweek']);
                    if ($days) {
                        $flags['/d'] = $days;
                    }
                }

                $months = $this->getMonths($periods['month']);
                if ($months) {
                    $flags['/m'] = $months;
                }
                break;
        }

        if (null !== $interval) {
            $flags['/mo'] = implode(",", $interval);
        }

        $time = $this->getTime($periods['hour'], $periods['minute']);
        if (null !== $time) {
            $flags['/st'] = $time;
        }

        $result = null;
        foreach ($flags as $flag => $value) {
            $result .= (
                $result !== null
                ? ' '
                : ''
            ) . $flag . ' ' . $value;
        }

        return $result;
    }

    /**
     * Determin if the given periods have a value
     *
     * @param array $periods
     * @return boolean
     */
    private function hasValue(array $periods)
    {
        foreach ($periods as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE
                && $period->get() !== null) {
                return true;
            }
        }
        return false;
    }

    /**
     * Determines the schedule type
     *
     * @param array $periods
     * @return string
     */
    private function scheduleType(array $periods)
    {
        if ($this->hasValue($periods['month'])) {
            return 'MONTHLY';
        }
        if ($this->hasValue($periods['dayofweek'])) {
            return 'WEEKLY';
        }
        if ($this->hasValue($periods['dayofmonth'])) {
            return 'DAILY';
        }
        if (null !== $this->getInterval($periods['hour'])) {
            return 'HOURLY';
        }
        return 'MINUTE';
    }

    /**
     * Builds the days of the month scheduled
     *
     * @param array $periods
     * @return string
     */
    private function getDaysOfMonth(array $periods)
    {
        $days = array();
        foreach ($periods as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE) {
                $days[] = $period->get();
            }
        }
        return implode(',', $days);
    }

    /**
     * Builds the days of the week scheduled
     *
     * @param array $periods
     * @return type
     */
    private function getDaysOfWeek(array $periods)
    {
        $days = array();
        foreach ($periods as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE) {
                $day = $this->formatDay($period->get());
                if ($day) {
                    $days[] = $day;
                }
            }
        }
        return implode(',', $days);
    }

    /**
     * Formats a day from int to string
     *
     * @param int $day
     * @return string
     */
    private function formatDay($day)
    {
        switch ($day) {
            case 0:
                return 'SUN';
            case 1:
                return 'MON';
            case 2:
                return 'TUE';
            case 3:
                return 'WED';
            case 4:
                return 'THU';
            case 5:
                return 'FRI';
            case 6:
                return 'SAT';
        }
        return null;
    }

    /**
     * Fetches the months scheduled
     *
     * @param array $periods
     * @return string
     */
    private function getMonths(array $periods)
    {
        $months = array();
        foreach ($periods as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE) {
                $month = $this->formatMonth($period->get());
                if ($month) {
                    $months[] = $month;
                }
            }
        }
        return implode(',', $months);
    }

    /**
     * Formats a month from int to string
     *
     * @param int $month
     * @return string
     */
    private function formatMonth($month)
    {
        switch ($month) {
            case 1:
                return 'JAN';
            case 2:
                return 'FEB';
            case 3:
                return 'MAR';
            case 4:
                return 'APR';
            case 5:
                return 'MAY';
            case 6:
                return 'JUN';
            case 7:
                return 'JUL';
            case 8:
                return 'AUG';
            case 9:
                return 'SEP';
            case 10:
                return 'OCT';
            case 11:
                return 'NOV';
            case 12:
                return 'DEC';
        }
        return null;
    }

    /**
     * Return the start time suitable for the '/st' flag
     *
     * @param array $hours Array of \Tictock\Schedule\Period\PeriodInterface
     * @param array $minutes Array of \Tictock\Schedule\Period\PeriodInterface
     * @param string The HH:MM format to execute, null if not set
     */
    private function getTime(array $hours, array $minutes)
    {
        $hour = null;
        $minute = "00";
        foreach ($hours as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE
                && null !== $period->get()) {
                $hour = str_pad($period->get(), 2, '0', STR_PAD_LEFT);
                break;
            }
        }
        foreach ($minutes as $period) {
            if ($period->getType() === PeriodInterface::TYPE_VALUE
                && null !== $period->get()) {
                $minute = str_pad($period->get(), 2, '0', STR_PAD_LEFT);
                break;
            }
        }

        if ($hour) {
            return $hour . ":" . $minute;
        }
        return null;
    }

    /**
     * Return the interval suitable for the '/mo' flag
     *
     * @param array $periods Array of \Tictock\Schedule\Period\PeriodInterface
     * @return int The interval
     */
    private function getInterval(array $periods)
    {
        foreach ($periods as $period) {
            if ($period->getType() === PeriodInterface::TYPE_INTERVAL) {
                return $period->get();
            }
        }
        return null;
    }

    /**
     * Formats periods by type
     *
     * @param array $periods Array of \Tictock\Schedule\Period\PeriodInterface
     * @return array An array of \Tictock\Schedule\Period\PeriodInterface formatted by type
     */
    private function formatPeriods(array $periods)
    {
        $formattedPeirods = array(
            'minute' => array(),
            'hour' => array(),
            'dayofmonth' => array(),
            'month' => array(),
            'dayofweek' => array()
        );
        foreach ($periods as $period) {
            $formattedPeirods[$period->getPeriod()][] = $period;
        }
        return $formattedPeirods;
    }
}
