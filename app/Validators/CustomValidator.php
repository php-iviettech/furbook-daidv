<?php

namespace Furbook\Validators;

use Illuminate\Validation\Validator;
use Furbook\Helpers\Common;

class CustomValidator extends Validator
{
    public function validateCurrencySize($attribute, $value, $parameters)
    {
        $currency_length = strlen(Common::convertDecimal($value));
        $min = $parameters[0];
        if (isset($parameters[1])) {
            $max = $parameters[1];
            return $min <= $currency_length && $currency_length <= $max;
        }
        return $min <= $currency_length;
    }

    protected function replaceCurrencySize($message, $attribute, $rule, $parameters)
    {
        if (isset($parameters[1])) {
            return str_replace([':min', ':max'], [$parameters[0], @$parameters[1]], $message);
        }
        return str_replace([':min'], [$parameters[0]], $message);
    }
}