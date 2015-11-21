<?php

namespace Kanunak\test\Money;

use Kanunak\Money\Currency;
use Kanunak\Money\CurrencyPair;

class CurrencyPairTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldReturnAValidCurrencyPairWithTheCorrectValues()
    {
        $currencyFrom = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyTo = new Currency(Currency::CURRENCY_CODE_US_DOLLAR);
        $ratio = 1.5;

        $currencyPair = new CurrencyPair($currencyFrom, $currencyTo, $ratio);

        $this->assertEquals($currencyFrom, $currencyPair->currencyFrom());
        $this->assertEquals($currencyTo, $currencyPair->currencyTo());
        $this->assertEquals($ratio, $currencyPair->ratio());
    }

    /**
     * @test
     */
    public function itShouldThrowInvalidArgumentExceptionWhenRatioIsNotFloat()
    {
        $currencyFrom = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyTo = new Currency(Currency::CURRENCY_CODE_US_DOLLAR);
        $ratio = 'ratio';

        $this->setExpectedException('\InvalidArgumentException', 'Ratio is not float');

        new CurrencyPair($currencyFrom, $currencyTo, $ratio);
    }
}
