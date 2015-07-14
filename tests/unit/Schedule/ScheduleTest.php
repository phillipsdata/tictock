<?php
namespace tictock\Tests\Schedule;

use tictock\Schedule\Schedule;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \tictock\Schedule\Schedule
 */
class ScheduleTest extends PHPUnit_Framework_TestCase
{
    private $schedule;
    
    public function setUp()
    {
        $this->schedule = new Schedule();
    }

    /**
     * @covers ::__construct
     */
    public function testConstruct()
    {
        $factory = $this->getMockBuilder('\tictock\Schedule\Period\PeriodFactoryInterface')
            ->getMock();
        $this->assertInstanceOf('\tictock\Schedule\Schedule', new Schedule($factory));
    }

    /**
     * @covers ::every
     * @covers ::__construct
     * @uses \tictock\Schedule\Adjective\Every::__construct
     */
    public function testEvery()
    {
        $this->assertInstanceOf('\tictock\Schedule\Adjective\Every', $this->schedule->every());
    }
    
    /**
     * @covers ::only
     * @covers ::__construct
     * @uses \tictock\Schedule\Adjective\Only::__construct
     */
    public function testOnly()
    {
        $this->assertInstanceOf('\tictock\Schedule\Adjective\Only', $this->schedule->only());
    }
    
    /**
     * @covers ::set
     * @covers ::getPeriods
     * @covers ::__construct
     */
    public function testSet()
    {
        $period = $this->getMockBuilder('\tictock\Schedule\Period\PeriodInterface')
            ->getMock();
        
        $this->assertEmpty($this->schedule->getPeriods());
        $this->assertContains($period, $this->schedule->set($period)->getPeriods());
    }
    
    /**
     * @covers ::getShorthand
     * @covers ::__construct
     * @dataProvider shorthandProvider
     */
    public function testGetShorthand($expected, Schedule $schedule)
    {
        $this->assertEquals($expected, $schedule->getShorthand());
    }
    
    public function shorthandProvider()
    {
        $calls = array();

        $schedule = new Schedule();
        $period = $this->periodMock(5, 'interval', 'minute');
        $schedule->set($period);
        $period = $this->periodMock(4, 'value', 'hour');
        $schedule->set($period);
        $period = $this->periodMock(3, 'value', 'dayofmonth');
        $schedule->set($period);
        $period = $this->periodMock(null, 'value', 'month');
        $schedule->set($period);
        $period = $this->periodMock(0, 'value', 'dayofweek');
        $schedule->set($period);
        
        $calls[] = array('*/5 4 3 * 0', $schedule);
        $calls[] = array('* * * * *', new Schedule());
        
        return $calls;
    }
    
    private function periodMock($val, $type, $period)
    {
        $periodMock = $this->getMockBuilder('\tictock\Schedule\Period\PeriodInterface')
            ->getMock();
        $periodMock->expects($this->any())
            ->method('get')
            ->will($this->returnValue($val));
        $periodMock->expects($this->any())
            ->method('getType')
            ->will($this->returnValue($type));
        $periodMock->expects($this->any())
            ->method('getPeriod')
            ->will($this->returnValue($period));
        return $periodMock;
    }
}
