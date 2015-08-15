<?php
namespace tictock\Tests\Unit\Schedule\Adjective;

use tictock\Schedule\Adjective\Every;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \tictock\Schedule\Adjective\Every
 */
class EveryTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::minute
     */
    public function testMinute()
    {
        $adj = $this->initializeWithMocks('createMinute');
        $adj->minute();
    }
    
    /**
     * @covers ::__construct
     * @covers ::minutes
     */
    public function testMinutes()
    {
        $interval = 5;
        $adj = $this->initializeWithMocks(
            'createMinute',
            array($this->equalTo($interval), 'interval')
        );
        $adj->minutes($interval);
    }
    
    /**
     * @covers ::__construct
     * @covers ::hour
     */
    public function testHour()
    {
        $adj = $this->initializeWithMocks('createHour');
        $adj->hour();
    }
    
    /**
     * @covers ::__construct
     * @covers ::hours
     */
    public function testHours()
    {
        $interval = 3;
        $adj = $this->initializeWithMocks(
            'createHour',
            array($this->equalTo($interval), 'interval')
        );
        $adj->hours($interval);
    }

    /**
     * @covers ::__construct
     * @covers ::dayOfTheMonth
     */
    public function testDayOfTheMonth()
    {
        $adj = $this->initializeWithMocks('createDayOfMonth');
        $adj->dayOfTheMonth();
    }

    /**
     * @covers ::__construct
     * @covers ::daysOfTheMonth
     */
    public function testDaysOfTheMonth()
    {
        $interval = 2;
        $adj = $this->initializeWithMocks(
            'createDayOfMonth',
            array($this->equalTo($interval), 'interval')
        );
        $adj->daysOfTheMonth($interval);
    }

    /**
     * @covers ::__construct
     * @covers ::month
     */
    public function testMonth()
    {
        $adj = $this->initializeWithMocks('createMonth');
        $adj->month();
    }

    /**
     * @covers ::__construct
     * @covers ::months
     */
    public function testMonths()
    {
        $interval = 6;
        $adj = $this->initializeWithMocks(
            'createMonth',
            array($this->equalTo($interval), 'interval')
        );
        $adj->months($interval);
    }

    /**
     * @covers ::__construct
     * @covers ::dayOfTheWeek
     */
    public function testDayOfTheWeek()
    {
        $adj = $this->initializeWithMocks('createDayOfWeek');
        $adj->dayOfTheWeek();
    }

    /**
     * @covers ::__construct
     * @covers ::daysOfTheWeek
     */
    public function testDaysOfTheWeek()
    {
        $interval = 3;
        $adj = $this->initializeWithMocks(
            'createDayOfWeek',
            array($this->equalTo($interval), 'interval')
        );
        $adj->daysOfTheWeek($interval);
    }

    protected function mockSchedule()
    {
        return $this->getMockBuilder('\tictock\Schedule\ScheduleInterface')
            ->getMock();
    }

    protected function mockPeriodFactory()
    {
        return $this->getMockBuilder('\tictock\Schedule\Period\PeriodFactoryInterface')
            ->getMock();
    }

    protected function mockPeriod()
    {
        return $this->getMockBuilder('\tictock\Schedule\Period\PeriodInterface')
            ->getMock();
    }

    protected function initializeWithMocks($method, array $expects = array())
    {
        $period = $this->mockPeriod();

        $mockPeriodFactory = $this->mockPeriodFactory();
        $mockPeriodFactory->expects($this->once())
            ->method($method)
            ->will($this->returnValue($period))
            ->withConsecutive($expects);

        $mockSchedule = $this->mockSchedule();
        $mockSchedule->expects($this->once())
            ->method('set')
            ->with($period);

        return new Every($mockSchedule, $mockPeriodFactory);
    }
}
