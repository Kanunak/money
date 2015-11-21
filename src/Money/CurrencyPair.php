<?php

namespace Kanunak\Money;

class CurrencyPair
{
    /** @var Currency  */
    private $currencyFrom;

    /** @var Currency  */
    private $currencyTo;

    /** @var  float */
    private $ratio;

    /**
     * @param Currency $currencyFrom
     * @param Currency $currencyTo
     * @param $ratio
     */
    public function __construct(Currency $currencyFrom, Currency $currencyTo, $ratio)
    {
        $this->validateRatio($ratio);
        $this->currencyFrom = $currencyFrom;
        $this->currencyTo = $currencyTo;
        $this->ratio = $ratio;
    }

    /**
     * @return Currency
     */
    public function currencyFrom()
    {
        return $this->currencyFrom;
    }

    /**
     * @return Currency
     */
    public function currencyTo()
    {
        return $this->currencyTo;
    }

    /**
     * @return float
     */
    public function ratio()
    {
        return $this->ratio;
    }

    /**
     * @param $ratio
     * @throw \InvalidArgumentException
     */
    private function validateRatio($ratio)
    {
        if (!is_float($ratio)) {
            throw new \InvalidArgumentException('Ratio is not float');
        }
    }
}
