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
    public function itShouldThorwInvalidArgumentExceptionWithAnInvalidCurrencyCode()
    {
        $currencyCode = 'XXX';

        $this->setExpectedException(
            '\InvalidArgumentException',
            'Provided value for Kanunak\Money\Currency is not valid: '.$currencyCode
        );

        new Currency($currencyCode);
    }
}
