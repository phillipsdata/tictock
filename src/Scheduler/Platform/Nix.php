<?php
namespace Tictock\Scheduler\Platform;

use Tictock\Scheduler\SchedulerInterface;
use Tictock\Schedule\ScheduleInterface;

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
