<?php
namespace tictock;

use tictock\Schedule\Schedule;
use tictock\Schedule\ScheduleInterface;
use tictock\Scheduler\SchedulerInterface;
use tictock\Scheduler\SchedulerFactory;

/**
 * An OS independent task scheduler.
 */
class TicTock
{
    /**
     * @var string The command
     */
    protected $cmd;

    /**
     * Initialize
     *
     * @param string $cmd The command
     */
    public function __construct($cmd)
    {
        $this->cmd = $cmd;
    }

    /**
     * Initializes the build-in schedule
     *
     * @return Schedule
     * @see tictock\Schedule\ScheduleInterface
     */
    public function schedule()
    {
        return new Schedule();
    }

    /**
     * Initializes the build-in scheduler for the given platform
     *
     * @param string $platform The platform
     * @return SchedulerInterface
     */
    public function scheduler($platform = null)
    {
        $factory = new SchedulerFactory();
        return $factory->create($platform);
    }

    /**
     * Invoke the scheduler to save the command at the given schedule
     *
     * @param ScheduleInterface $schedule
     * @param SchedulerInterface $scheduler
     */
    public function save(ScheduleInterface $schedule, SchedulerInterface $scheduler = null)
    {
        if (null === $scheduler) {
            $scheduler = $this->scheduler();
        }
        $scheduler->save($schedule, $this->cmd);
    }
}
