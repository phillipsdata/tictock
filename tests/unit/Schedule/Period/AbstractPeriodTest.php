<?php
namespace tictock\Tests\Unit\Schedule\Period;

use tictock\Schedule\Period\AbstractPeriod;
use tictock\Schedule\Period\PeriodInterface;
use PHPUnit_Framework_TestCase;
use ReflectionClass;

/**
 * @coversDefaultClass \tictock\Schedule\Period\AbstractPeriod
 */
class AbstractPeriodTest extends PHPUnit_Framework_TestCase
{
    /**
     * @covers ::__construct
     * @expectedException \InvalidArgumentException
     */
    public function testConstructException()
    {
        $this->getMockBuilder('\tictock\Schedule\Period\AbstractPeriod')
            ->setConstructorArgs(array(null, null))
            ->getMock();
    }
    
    /**
     * @covers ::get
     * @covers ::__construct
     * @dataProvider getTypeProvider
     */
    public function testGet($val, $type)
    {
        $period = $this->getAbstractPeriod($val, $type);
        $this->assertEquals($val, $period->get());
    }

    /**
     * @covers ::getType
     * @covers ::__construct
     * @dataProvider getTypeProvider
     */
    public function testGetType($val, $type)
    {
        $period = $this->getAbstractPeriod($val, $type);
        $this->assertEquals($type, $period->getType());
    }
    
    /**
     * Data provider for testGetType and testGet
     */
    public function getTypeProvider()
    {
        return array(
            array(5, PeriodInterface::TYPE_VALUE),
            array(3, PeriodInterface::TYPE_INTERVAL)
        );
    }
    
    public function getAbstractPeriod($val, $type)
    {
        $class = '\tictock\Schedule\Period\AbstractPeriod';
        $period = $this->getMockBuilder($class)
            ->disableOriginalConstructor()
            ->setMethods(array('isValid', 'isValidInterval'))
            ->getMockForAbstractClass();

        $period->expects($this->any())
            ->method('isValid')
            ->will($this->returnValue(true));
        $period->expects($this->any())
            ->method('isValidInterval')
            ->will($this->returnValue(true));
            
        $reflectedClass = new ReflectionClass($class);
        $constructor = $reflectedClass->getConstructor();
        $constructor->invoke($period, $val, $type);
        return $period;
    }
}
