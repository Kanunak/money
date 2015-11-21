<?php

namespace Kanunak\Money;

use JimmyOak\DataType\Enum;

class Currency extends Enum
{
    const CURRENCY_CODE_EURO = 'EUR';
    const CURRENCY_CODE_US_DOLLAR = 'USD';
    const CURRENCY_CODE_BRITISH_POUND = 'GBP';

    /**
     * @param string $currencyCode
     */
    public function __construct($currencyCode)
    {
        parent::__construct($currencyCode);
    }

    /**
     * @return string
     */
    public function code()
    {
        return $this->value();
    }
}
