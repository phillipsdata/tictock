<?php
namespace tictock\Schedule\Period;

use tictock\Schedule\Period\PeriodInterface;

/**
 * Abstract Period
 */
abstract class AbstractPeriod implements PeriodInterface
{
    protected $val;
    protected $type;
    const MINUTE = 'minute';
    const HOUR = 'hour';
    const DAYOFMONTH = 'dayofmonth';
    const MONTH = 'month';
    const DAYOFWEEK = 'dayofweek';

    /**
     * {@inheritdoc}
     */
    public function __construct($val, $type = PeriodInterface::TYPE_VALUE)
    {
        if (($type === "value" && $this->isValid($val))
            || ($type === "interval" && $this->isValidInterval($val))) {
            $this->val = $val;
        }
        $this->type = $type;
    }

    /**
     * {@inheritdoc}
     */
    public function get()
    {
        return $this->val;
    }

    /**
     * {@inheritdoc}
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Verifies the the given value is valid
     *
     * @param int $val The value to test
     * @return boolean True if the value is valid, false otherwise
     */
    abstract protected function isValid($val);

    /**
     * Verifies the the given interval is valid
     *
     * @param int $interval The interval to test
     * @return boolean True if the interval is valid, false otherwise
     */
    abstract protected function isValidInterval($interval);
}
