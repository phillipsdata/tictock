<?php
namespace tictock\Tests\Scheduler\Platform {

    use tictock\Scheduler\Platform\Nix;
    use tictock\Scheduler\SchedulerInterface;
    use tictock\Schedule\ScheduleInterface;
    use PHPUnit_Framework_TestCase;
    
    /**
     * @coversDefaultClass \tictock\Scheduler\Platform\Nix
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
            
            $schedule = $this->getMockBuilder('\tictock\Schedule\ScheduleInterface')
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

namespace tictock\Scheduler\Platform {
    
    function exec($cmd, array &$out, &$return)
    {
        \tictock\Tests\Scheduler\Platform\NixTest::mockExec($cmd, $out, $return);
    }
}
