<?php

namespace Kanunak\test\Money;

use Kanunak\Money\Currency;
use Kanunak\Money\Money;

class MoneyTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     */
    public function itShouldReturnAValidMoneyWithCurrencyAndValue()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $value = 100000;

        $money = new Money($currency, $value);

        $this->assertSame($currency, $money->currency());
        $this->assertSame($value, $money->value());
    }

    /**
     * @test
     */
    public function itShouldThorwInvalidArgumentExceptionWhenAnInvalidValueIsPassed()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $value = 'value';

        $this->setExpectedException(
            '\InvalidArgumentException',
            'Provided value is not an integer: '.$value
        );

        new Money($currency, $value);
    }
}
