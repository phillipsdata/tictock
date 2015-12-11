<?php
namespace Tictock\Tests\Unit\Schedule\Adjective;

use Tictock\Schedule\Adjective\Only;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \Tictock\Schedule\Adjective\Only
 */
class OnlyTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @covers ::minutes
     */
    public function testMinutes()
    {
        $data = array(0, 15, 30, 45);
        $expects = array();
        foreach ($data as $val) {
            $expects[] = $this->equalTo($val);
        }
        $adj = $this->initializeWithMocks('createMinute', $expects);
        $adj->minutes($data);
    }

    /**
     * @covers ::__construct
     * @covers ::hours
     */
    public function testHours()
    {
        $data = array(0, 6, 12, 18);
        $expects = array();
        foreach ($data as $val) {
            $expects[] = $this->equalTo($val);
        }
        $adj = $this->initializeWithMocks('createHour', $expects);
        $adj->hours($data);
    }

    /**
     * @covers ::__construct
     * @covers ::daysOfTheMonth
     */
    public function testDaysOfTheMonth()
    {
        $data = array(1, 7, 14, 21);
        $expects = array();
        foreach ($data as $val) {
            $expects[] = $this->equalTo($val);
        }
        $adj = $this->initializeWithMocks('createDayOfMonth', $expects);
        $adj->daysOfTheMonth($data);
    }

    /**
     * @covers ::__construct
     * @covers ::months
     */
    public function testMonths()
    {
        $data = array(1, 3, 6, 9, 12);
        $expects = array();
        foreach ($data as $val) {
            $expects[] = $this->equalTo($val);
        }
        $adj = $this->initializeWithMocks('createMonth', $expects);
        $adj->months($data);
    }

    /**
     * @covers ::__construct
     * @covers ::daysOfTheWeek
     */
    public function testDaysOfTheWeek()
    {
        $data = array(0, 2, 4, 6);
        $expects = array();
        foreach ($data as $val) {
            $expects[] = $this->equalTo($val);
        }
        $adj = $this->initializeWithMocks('createDayOfWeek', $expects);
        $adj->daysOfTheWeek($data);
    }

    protected function mockSchedule()
    {
        return $this->getMockBuilder('\Tictock\Schedule\ScheduleInterface')
            ->getMock();
    }

    protected function mockPeriodFactory()
    {
        return $this->getMockBuilder('\Tictock\Schedule\Period\PeriodFactoryInterface')
            ->getMock();
    }

    protected function mockPeriod()
    {
        return $this->getMockBuilder('\Tictock\Schedule\Period\PeriodInterface')
            ->getMock();
    }

    protected function initializeWithMocks($method, array $expects = array())
    {
        $period = $this->mockPeriod();

        $times = count($expects);
        $mockPeriodFactory = $this->mockPeriodFactory();

        foreach ($expects as $i => $expect) {
            $mockPeriodFactory->expects($this->at($i))
                ->method($method)
                ->will($this->returnValue($period))
                ->with($expect);
        }

        $mockSchedule = $this->mockSchedule();
        $mockSchedule->expects($this->exactly($times))
            ->method('set')
            ->with($period);

        return new Only($mockSchedule, $mockPeriodFactory);
    }
}
