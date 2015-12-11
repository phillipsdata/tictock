<?php
namespace Tictock\Tests;

use Tictock\Tictock;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \Tictock\Tictock
 */
class TictockTest extends PHPUnit_Framework_TestCase
{
    
    private function getTictock()
    {
        return new Tictock('echo hello world');
    }
    
    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $this->assertInstanceOf('\Tictock\Tictock', $this->getTictock());
    }

    /**
     * @covers ::schedule
     * @uses \Tictock\Tictock::__construct
     * @uses \Tictock\Schedule\Schedule
     */
    public function testSchedule()
    {
        $this->assertInstanceOf(
            '\Tictock\Schedule\ScheduleInterface',
            $this->getTictock()->schedule()
        );
    }
    
    /**
     * @covers ::scheduler
     * @uses \Tictock\Tictock::__construct
     * @uses \Tictock\Scheduler\SchedulerFactory
     * @uses \Tictock\Scheduler\Platform\Windows
     * @uses \Tictock\Scheduler\Platform\Nix
     */
    public function testScheduler()
    {
        $this->assertInstanceOf(
            '\Tictock\Scheduler\Platform\Windows',
            $this->getTictock()->scheduler('windows')
        );
        $this->assertInstanceOf(
            '\Tictock\Scheduler\Platform\Nix',
            $this->getTictock()->scheduler('nix')
        );
        $this->assertInstanceOf(
            '\Tictock\Scheduler\SchedulerInterface',
            $this->getTictock()->scheduler()
        );
    }
    
    /**
     * @covers ::save
     * @uses \Tictock\Tictock::__construct
     */
    public function testSave()
    {
        $schedule = $this->getMock('\Tictock\Schedule\ScheduleInterface');
        $scheduler = $this->getMock('\Tictock\Scheduler\SchedulerInterface');
        $scheduler->expects($this->once())
            ->method('save')
            ->with(
                $this->equalTo($schedule),
                $this->anything()
            );
        
        $this->getTictock()->save($schedule, $scheduler);
    }
    
    /**
     * @covers ::save
     */
    public function testSaveWithoutScheduler()
    {
        $schedule = $this->getMock('\Tictock\Schedule\ScheduleInterface');
        $scheduler = $this->getMock('\Tictock\Scheduler\SchedulerInterface');
        $scheduler->expects($this->once())
            ->method('save')
            ->with(
                $this->equalTo($schedule),
                $this->anything()
            );
        
        $tictock = $this->getMockBuilder('\Tictock\Tictock')
            ->disableOriginalConstructor()
            ->setMethods(array('scheduler'))
            ->getMock();
        $tictock->method('scheduler')
            ->will($this->returnValue($scheduler));
        
        $tictock->save($schedule);
    }
}
