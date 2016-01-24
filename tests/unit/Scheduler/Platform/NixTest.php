<?php
namespace Tictock\Tests\Scheduler\Platform {

    use Tictock\Scheduler\Platform\Nix;
    use PHPUnit_Framework_TestCase;

    /**
     * @coversDefaultClass \Tictock\Scheduler\Platform\Nix
     */
    class NixTest extends PHPUnit_Framework_TestCase
    {
        protected static $execCmd = null;
        protected static $execReturn = null;
        protected static $execOut = null;

        /**
         * @covers ::save
         * @covers ::output
         */
        public function testSave()
        {
            $cmd = '/path/to/program';
            $period = '*/5 * * * *';
            $nix = new Nix();

            $expectedOut = 'crontab: installing new crontab';
            $expectedReturn = 0;

            $this->execShould(
                'crontab ' . $period . ' ' . $cmd,
                $expectedOut,
                $expectedReturn
            );

            $schedule = $this->getMockBuilder('\Tictock\Schedule\ScheduleInterface')
                ->getMock();
            $schedule->expects($this->once())
                ->method('getShorthand')
                ->will($this->returnValue($period));

            $this->assertEquals(
                $expectedReturn,
                $nix->save($schedule, $cmd)
            );

            $this->assertEquals($expectedOut, $nix->output());
        }

        /**
         * @covers ::scheduled
         */
        public function testScheduled()
        {
            $nix = new Nix();

            $this->execShould(
                'crontab -l',
                array(
                    '*/5 * * * * /path/to/program',
                    '* * * * * program param1 param2 < in > out'
                )
            );

            $this->assertEquals(
                array(
                    '/path/to/program',
                    'program param1 param2 < in > out'
                ),
                $nix->scheduled()
            );
        }

        /**
         * @covers ::scheduled
         */
        public function testScheduledWithSearch()
        {
            $nix = new Nix();

            $this->execShould(
                'crontab -l',
                array('* * * * * program param1 param2 < in > out')
            );

            $this->assertEquals(
                array('program param1 param2 < in > out'),
                $nix->scheduled('/out/')
            );
        }

        /**
         * Set the expectation for exec()
         *
         * @param string $expect
         * @param string $output
         * @param int $return
         */
        protected static function execShould($expect = null, $output = null, $return = null)
        {
            self::$execCmd = $expect;
            self::$execOut = $output;
            self::$execReturn = $return;
        }

        /**
         * A cheap exec mock
         */
        public static function mockExec($cmd, array &$out, &$return)
        {
            if (self::$execCmd === $cmd) {
                $return = self::$execReturn;
                $out = self::$execOut;
                return $return;
            }
            $out = 'error';
            return 1;
        }
    }
}

namespace Tictock\Scheduler\Platform {

    function exec($cmd, array &$out = null, &$return = null)
    {
        \Tictock\Tests\Scheduler\Platform\NixTest::mockExec($cmd, $out, $return);
    }
}
