<?php
namespace tictock;

use tictock\Schedule\Schedule;

class TicTock
{
    protected $cmd;

    public function __construct($cmd)
    {
        $this->cmd = $cmd;
    }

    public function schedule()
    {
        return new Schedule();
    }

    public function save($schedule)
    {
        #
        # TODO: Execute OS-dependent command
        #
        print_r($schedule->getPeriods());
    }
}
