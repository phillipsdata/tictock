<?php
namespace tictock\Scheduler\Platform;

use tictock\Scheduler\SchedulerInterface;
use tictock\Schedule\ScheduleInterface;

class Windows implements SchedulerInterface
{

    private $output = array();

    /**
     * {@inheritdoc}
     */
    public function save(ScheduleInterface $schedule, $cmd)
    {
        #
        # TODO:
        #
        return 0;
    }

    /**
     * {@inheritdoc}
     */
    public function output()
    {
        return $this->output;
    }
}
