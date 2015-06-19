<?php
namespace tictock\Scheduler\Platform;

use tictock\Scheduler\SchedulerInterface;
use tictock\Schedule\ScheduleInterface;

class Windows implements SchedulerInterface
{

    private $output = array();
    private $name = null;
    const COMMAND = 'schtasks';

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
            : '"' . substr($cmd, -32) . '"';

        echo self::COMMAND . ' /create /sc ' . $this->getScheduleCommand($schedule) . ' /tn ' . $name . ' /tr ' . $cmd;
        //exec(self::COMMAND . ' ' . $schedule->getShorthand() . ' ' . $cmd, $output, $return);
        //$this->output = $output;
        //return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function output()
    {
        return $this->output;
    }

    private function getScheduleCommand(ScheduleInterface $schedule)
    {
        #
        # TODO: Determine the type: MINUTE, HOURLY, DAILY, WEEKLY, MONTHLY
        #
        $type = 'MINUTE';

        $flags = array();

        switch ($type) {
            case 'MINUTE':
                // set /mo 1 - 1439 run ever N minutes
                // set /st for start time HH:MM format
                break;
            case 'HOURLY':
                // set /mo 1 - 23 run ever N hours
                // set /st for start time HH:MM format
                break;
            case 'DAILY':
                // set /mo 1 - 365 run ever N days
                // set /st for start time HH:MM format
                break;
            case 'WEEKLY':
                // set /mo 1 - 52 run ever N weeks
                // set /d (day of the week MON-SUN)
                // set /st for start time HH:MM format
                break;
            case 'MONTHLY':
                // set /mo 1 - 12 run ever N months
                // set /d (day of the month, 1-31)
                // set /m (month of the year, JAN-DEC)
                // set /st for start time HH:MM format
                break;
        }

        $result = $type;
        foreach ($flags as $flag => $value) {
            $result .= ' ' . $flag . ' ' . $value;
        }

        return $result;
    }
}
