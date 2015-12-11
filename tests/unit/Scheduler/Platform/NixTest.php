<?php
namespace Tictock\Tests\Scheduler\Platform {

    use Tictock\Scheduler\Platform\Nix;
    use Tictock\Scheduler\SchedulerInterface;
    use Tictock\Schedule\ScheduleInterface;
    use PHPUnit_Framework_TestCase;
    
    /**
     * @coversDefaultClass \Tictock\Scheduler\Platform\Nix
     */
    class NixTest extends PHPUnit_Framework_TestCase
    {
        protected static $expectedCmd = 'crontab */5 * * * * /path/to/program';
        protected static $shouldOutput = array('crontab: installing new crontab');
        protected static $shouldReturn = 0;
        
        /**
         * @covers ::save
         * @covers ::output
         */
        public function testSave()
        {
            $cmd = '/path/to/program';
            $period = '*/5 * * * *';
            $nix = new Nix();
            
            $schedule = $this->getMockBuilder('\Tictock\Schedule\ScheduleInterface')
                ->getMock();
            $schedule->expects($this->once())
                ->method('getShorthand')
                ->will($this->returnValue($period));
                
            $this->assertEquals(
                self::$shouldReturn,
                $nix->save($schedule, $cmd)
            );
            
            $this->assertEquals(self::$shouldOutput, $nix->output());
        }
        
        /**
         * A cheap exec mock
         */
        public static function mockExec($cmd, array &$out, &$return)
        {
            if ($cmd === self::$expectedCmd) {
                $out = self::$shouldOutput;
                $return = self::$shouldReturn;
                return;
            }
            $out = 'error';
            return 1;
        }
    }
}

namespace Tictock\Scheduler\Platform {
    
    function exec($cmd, array &$out, &$return)
    {
        \Tictock\Tests\Scheduler\Platform\NixTest::mockExec($cmd, $out, $return);
    }
}
