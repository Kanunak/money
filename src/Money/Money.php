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

    /**
     * @param Money $moneyToSubtract
     * @return Money
     * @throw \InvalidArgumentException
     */
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
     * @throw \InvalidArgumentException
     */
    public function equals(Money $moneyToCompare)
    {
        if ($this->isSameCurrency($moneyToCompare)) {
            return $this->value() === $moneyToCompare->value();
        }
        return false;
    }

    /**
     * @param CurrencyPair $currencyPair
     * @return Money
     * @throw \InvalidArgumentException
     */
    public function exchange(CurrencyPair $currencyPair)
    {
        if (!$this->isSameCurrencyInCurrencyPair($currencyPair)) {
            throw new \InvalidArgumentException('CurrencyFrom in the CurrencyPair does not match the money currency');
        }
        return new Money($currencyPair->currencyTo(), (int)($this->value() * $currencyPair->ratio()));
    }

    /**
     * @param CurrencyPair $currencyPair
     * @return bool
     */
    private function isSameCurrencyInCurrencyPair(CurrencyPair $currencyPair)
    {
        return ($this->currency()->equals($currencyPair->currencyFrom()));
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
