<?php
namespace tictock\Scheduler\Platform;

use tictock\Scheduler\SchedulerInterface;
use tictock\Schedule\ScheduleInterface;

class Nix implements SchedulerInterface
{
    const CRON = 'crontab';

    private $output = array();

    /**
     * {@inheritdoc}
     */
    public function save(ScheduleInterface $schedule, $cmd)
    {
        exec(self::CRON . ' ' . $schedule->getShorthand() . ' ' . $cmd, $output, $return);
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
}
