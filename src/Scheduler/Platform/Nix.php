<?php
namespace tictock\Scheduler\Platform;

use tictock\Scheduler\SchedulerInterface;
use tictock\Schedule\ScheduleInterface;

/**
 * *nix Task scheduler
 */
class Nix implements SchedulerInterface
{
    const CRON = 'crontab';

    private $output = array();

    /**
     * {@inheritdoc}
     */
    public function save(ScheduleInterface $schedule, $cmd)
    {
        $output = array();
        $return = 0;
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
