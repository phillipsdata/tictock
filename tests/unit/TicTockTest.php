<?php
namespace tictock\Tests;

use tictock\TicTock;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \tictock\TicTock
 */
class TicTockTest extends PHPUnit_Framework_TestCase
{
    
    private function getTicTock()
    {
        return new TicTock('echo hello world');
    }
    
    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('\tictock\TicTock', $this->getTicTock());
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
            $this->getTicTock()->schedule()
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
            $this->getTicTock()->scheduler('windows')
        );
        $this->assertInstanceOf(
            '\tictock\Scheduler\Platform\Nix',
            $this->getTicTock()->scheduler('nix')
        );
        $this->assertInstanceOf(
            '\tictock\Scheduler\SchedulerInterface',
            $this->getTicTock()->scheduler()
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
        
        $this->getTicTock()->save($schedule, $scheduler);
    }
    
    /**
     * @covers ::save
     */
    public function testSaveWithoutScheduler()
    {
        $schedule = $this->getMock('\tictock\Schedule\ScheduleInterface');
        $scheduler = $this->getMock('\tictock\Scheduler\SchedulerInterface');
        $scheduler->expects($this->once())
            ->method('save')
            ->with(
                $this->equalTo($schedule),
                $this->anything()
            );
        
        $tictock = $this->getMockBuilder('\tictock\TicTock')
            ->disableOriginalConstructor()
            ->setMethods(array('scheduler'))
            ->getMock();
        $tictock->method('scheduler')
            ->will($this->returnValue($scheduler));
        
        $tictock->save($schedule);
    }
}
