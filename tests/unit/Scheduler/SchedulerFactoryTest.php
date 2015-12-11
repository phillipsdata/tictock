<?php
namespace Tictock\Tests\Scheduler;

use Tictock\Scheduler\SchedulerFactory;
use PHPUnit_Framework_TestCase;

/**
 * @coversDefaultClass \Tictock\Scheduler\SchedulerFactory
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
     * @uses \Tictock\Scheduler\Platform\Windows
     * @uses \Tictock\Scheduler\Platform\Nix
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
            array('windows', '\Tictock\Scheduler\Platform\Windows'),
            array('nix', '\Tictock\Scheduler\Platform\Nix'),
            array('linux', '\Tictock\Scheduler\Platform\Nix'),
            array('unix', '\Tictock\Scheduler\Platform\Nix'),
            array(null, '\Tictock\Scheduler\SchedulerInterface')
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
