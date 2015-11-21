<?php

namespace Kanunak\Money;

class Money
{
    /** @var  Currency */
    private $currency;

    /** @var  int */
    private $value;

    /**
     * @param Currency $currency
     * @param int $value
     */
    public function __construct(Currency $currency, $value)
    {
        $this->validateValue($value);
        $this->currency = $currency;
        $this->value = $value;
    }

    /**
     * @return Currency
     */
    public function currency()
    {
        return $this->currency;
    }

    /**
     * @return int
     */
    public function value()
    {
        return $this->value;
    }

    /**
     * @param $value
     * @thrown \InvalidArgumentException
     */
    private function validateValue($value)
    {
        if (!is_integer($value)) {
            throw new \InvalidArgumentException('Provided value is not an integer: '.$value);
        }
    }
}
