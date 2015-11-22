<?php

namespace Kanunak\Money;

class Money
{
    const NUMBER_OF_DECIMALS = 4;

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
     * @return int
     */
    public function decimals()
    {
        return self::NUMBER_OF_DECIMALS;
    }

    /**
     * @param Money $moneyToAdd
     * @return Money
     * @throw \InvalidArgumentException
     */
    public function add(Money $moneyToAdd)
    {
        if (!$this->isSameCurrency($moneyToAdd)) {
            throw new \InvalidArgumentException('Currencies does not match');
        }
        return new Money($this->currency(), $this->value() + $moneyToAdd->value());
    }

    public function subtract(Money $moneyToSubtract)
    {
        if (!$this->isSameCurrency($moneyToSubtract)) {
            throw new \InvalidArgumentException('Currencies does not match');
        }
        return new Money($this->currency(), $this->value() - $moneyToSubtract->value());
    }

    /**
     * @param Money $moneyToCompare
     * @return bool
     */
    public function equals(Money $moneyToCompare)
    {
        if ($this->isSameCurrency($moneyToCompare)) {
            return $this->value() === $moneyToCompare->value();
        }
        return false;
    }

    /**
     * @param Money $money
     * @return bool
     */
    private function isSameCurrency(Money $money)
    {
        return ($this->currency()->equals($money->currency()));
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
