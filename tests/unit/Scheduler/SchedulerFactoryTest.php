<?php
namespace tictock\Tests\Scheduler;

use tictock\Scheduler\SchedulerFactory;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \tictock\Scheduler\SchedulerFactory
 */
class SchedulerFactoryTest extends PHPUnit_Framework_TestCase
{
    private $factory;
    
    public function setUp()
    {
        $this->factory = new SchedulerFactory();
    }

    /**
     * @covers ::create
     * @covers ::getPlatform
     * @uses \tictock\Scheduler\Platform\Windows
     * @uses \tictock\Scheduler\Platform\Nix
     * @dataProvider createProvider
     */
    public function testCreate($paltform, $instanceOf)
    {
        $this->assertInstanceOf(
            $instanceOf,
            $this->factory->create($paltform)
        );
    }
    
    /**
     * Data provider for testCreate
     */
    public function createProvider()
    {
        return array(
            array('windows', '\tictock\Scheduler\Platform\Windows'),
            array('nix', '\tictock\Scheduler\Platform\Nix'),
            array('linux', '\tictock\Scheduler\Platform\Nix'),
            array('unix', '\tictock\Scheduler\Platform\Nix'),
            array(null, '\tictock\Scheduler\SchedulerInterface')
        );
    }
    
    /**
     * @covers ::create
     * @expectedException \InvalidArgumentException
     */
    public function testCreateException()
    {
        $this->factory->create('bad platform');
    }
}
