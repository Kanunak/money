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

    /**
     * @test
     */
    public function itShouldReturnTrueWhenMoneyHaveSameValueAndCurrency()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $value = 1000;
        $money = new Money($currency, $value);
        $moneyToCompare = new Money($currency, $value);

        $this->assertTrue($money->equals($moneyToCompare));
    }

    /**
     * @test
     */
    public function itShouldReturnFalseWhenMoneyValueIsDifferentAndCurrencyIsEquals()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $value = 1000;
        $money = new Money($currency, $value);
        $moneyToCompare = new Money($currency, $value * 2);

        $this->assertFalse($money->equals($moneyToCompare));
    }

    /**
     * @test
     */
    public function itShouldReturnFalseWhenMoneyCurrencyIsDifferentAndValueIsTheSame()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $currencyToCompare = new Currency(Currency::CURRENCY_CODE_BRITISH_POUND);
        $value = 1000;
        $money = new Money($currency, $value);
        $moneyToCompare = new Money($currencyToCompare, $value);

        $this->assertFalse($money->equals($moneyToCompare));
    }

    /**
     * @test
     */
    public function itShouldReturnAMoneyWithValueAddedWithMoneysWithTheSameCurrency()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $money = new Money($currency, 1000);
        $moneyToAdd = new Money($currency, 2000);
        $expectedMoney = new Money($currency, 3000);

        $this->assertEquals($expectedMoney, $money->add($moneyToAdd));
    }

    /**
     * @test
     */
    public function itShouldThrowInvalidArgumentExceptionWhenCurrenciesAreDifferentWhileAdding()
    {
        $money = new Money(new Currency(Currency::CURRENCY_CODE_EURO), 1000);
        $moneyToAdd = new Money(new Currency(Currency::CURRENCY_CODE_US_DOLLAR), 2000);

        $this->setExpectedException('\InvalidArgumentException', 'Currencies does not match');

        $money->add($moneyToAdd);
    }

    /**
     * @test
     */
    public function itShouldReturnAMoneyWithValueSubtractWithMoneysWithTheSameCurrency()
    {
        $currency = new Currency(Currency::CURRENCY_CODE_EURO);
        $money = new Money($currency, 2000);
        $moneyToSubtract = new Money($currency, 1000);
        $expectedMoney = new Money($currency, 1000);

        $this->assertEquals($expectedMoney, $money->subtract($moneyToSubtract));
    }

    /**
     * @test
     */
    public function itShouldThrowInvalidArgumentExceptionWhenCurrenciesAreDifferentWhileSubtracting()
    {
        $money = new Money(new Currency(Currency::CURRENCY_CODE_EURO), 1000);
        $moneyToSubtract = new Money(new Currency(Currency::CURRENCY_CODE_US_DOLLAR), 2000);

        $this->setExpectedException('\InvalidArgumentException', 'Currencies does not match');

        $money->subtract($moneyToSubtract);
    }

    /**
     * @test
     */
    public function itShouldReturnTheNumberOfDecimalsOfMoney()
    {
        $money = new Money(new Currency(Currency::CURRENCY_CODE_US_DOLLAR), 10000);
        $this->assertEquals(4, $money->decimals());
    }
}
