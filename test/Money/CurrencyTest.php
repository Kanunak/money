<?php

namespace Kanunak\test\Money;

use Kanunak\Money\Currency;

class CurrencyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldReturnAValidCurrencyWithAValidCurrencyCode()
    {
        $currencyCode = Currency::CURRENCY_CODE_EURO;

        $currency = new Currency($currencyCode);

        $this->assertSame($currencyCode, $currency->code());
    }

    /**
     * @test
     */
    public function itShouldThrowInvalidArgumentExceptionWithAnInvalidCurrencyCode()
    {
        $currencyCode = 'XXX';

        $this->setExpectedException(
            '\InvalidArgumentException',
            'Provided value for Kanunak\Money\Currency is not valid: '.$currencyCode
        );

        new Currency($currencyCode);
    }

    /**
     * @test
     */
    public function itShouldReturnTrueWhenTheCurrencyCodesAreEquals()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyToCompare = new Currency(Currency::CURRENCY_CODE_EURO);

        $this->assertTrue($currency->equals($currencyToCompare));
    }

    /**
     * @test
     */
    public function itShouldReturnFalseWhenTheCurrencyCodesAreDifferent()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyToCompare = new Currency(Currency::CURRENCY_CODE_EURO);

        $this->assertTrue($currency->equals($currencyToCompare));
    }
}
