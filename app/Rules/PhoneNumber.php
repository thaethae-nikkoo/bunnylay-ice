<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhoneNumber implements Rule
{
    public function passes($attribute, $value) : bool
    {
        // Check if the value contains any myanmar characters or english letters
       return preg_match('/^[0-9+\-\s().]+$/', $value);
    }

    public function message() : string
    {
        return __('validation.custom.invalid_phone_number');
    }
}
