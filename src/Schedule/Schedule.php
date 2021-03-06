<?php
namespace Tictock\Schedule;

use Tictock\Schedule\Period\PeriodInterface;
use Tictock\Schedule\Period\PeriodFactoryInterface;
use Tictock\Schedule\Period\PeriodFactory;
use Tictock\Schedule\Adjective\Every;
use Tictock\Schedule\Adjective\Only;

/**
 * Schedule manager
 */
class Schedule implements ScheduleInterface
{
    private $periods = array();
    private $periodFactory;

    /**
     * Initialize the schedule
     *
     * @param PeriodFactoryInterface $periodFactory
     */
    public function __construct(PeriodFactoryInterface $periodFactory = null)
    {
        if (null !== $periodFactory) {
            $this->periodFactory = $periodFactory;
        } else {
            $this->periodFactory = new PeriodFactory();
        }
    }

    /**
     * {@inheritdoc}
     */
    public function every()
    {
        return new Every($this, $this->periodFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function only()
    {
        return new Only($this, $this->periodFactory);
    }

    /**
     * {@inheritdoc}
     */
    public function set(PeriodInterface $period)
    {
        $this->periods[] = $period;
        return $this;
    }

    /**
     * {@inheritdoc}
     */
    public function getPeriods()
    {
        return $this->periods;
    }

    /**
     * {@inheritdoc}
     */
    public function getShorthand()
    {
        $notation = array(
            'minute' => array('*'),
            'hour' => array('*'),
            'dayofmonth' => array('*'),
            'month' => array('*'),
            'dayofweek' => array('*')
        );
        foreach ($this->periods as $period) {
            $val = $period->get();
            $type = $period->getType();
            $periodType = $period->getPeriod();

            if ('interval' === $type) {
                $notation[$periodType] = array('*/' . $val);
            } else {
                if ('*' === $notation[$periodType][0]) {
                    $notation[$periodType] = array();
                }
                $notation[$periodType][] = null === $val
                    ? '*'
                    : $val;
            }
        }

        foreach ($notation as $key => &$value) {
            $value = implode(',', $value);
        }

        return implode(' ', $notation);
    }
}
