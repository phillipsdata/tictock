<?php
namespace tictock\Tests;

use tictock\TicTock;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \tictock\TicTock
 */
class TicTockTest extends PHPUnit_Framework_TestCase
{
    private $tictock;
    
    public function setUp()
    {
        $this->tictock = new TicTock('echo hello world');
    }
    
    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('\tictock\TicTock', $this->tictock);
    }

    /**
     * @covers ::schedule
     * @uses \tictock\TicTock::__construct
     * @uses \tictock\Schedule\Schedule
     */
    public function testSchedule()
    {
        $this->assertInstanceOf(
            '\tictock\Schedule\ScheduleInterface',
            $this->tictock->schedule()
        );
    }
    
    /**
     * @covers ::scheduler
     * @uses \tictock\TicTock::__construct
     * @uses \tictock\Scheduler\SchedulerFactory
     * @uses \tictock\Scheduler\Platform\Windows
     * @uses \tictock\Scheduler\Platform\Nix
     */
    public function testScheduler()
    {
        $this->assertInstanceOf(
            '\tictock\Scheduler\Platform\Windows',
            $this->tictock->scheduler('windows')
        );
        $this->assertInstanceOf(
            '\tictock\Scheduler\Platform\Nix',
            $this->tictock->scheduler('nix')
        );
        $this->assertInstanceOf(
            '\tictock\Scheduler\SchedulerInterface',
            $this->tictock->scheduler()
        );
    }
    
    /**
     * @covers ::save
     * @uses \tictock\TicTock::__construct
     */
    public function testSave()
    {
        $schedule = $this->getMock('\tictock\Schedule\ScheduleInterface');
        $scheduler = $this->getMock('\tictock\Scheduler\SchedulerInterface');
        $scheduler->expects($this->once())
            ->method('save')
            ->with(
                $this->equalTo($schedule),
                $this->anything()
            );
        
        $this->tictock->save($schedule, $scheduler);
    }
}
