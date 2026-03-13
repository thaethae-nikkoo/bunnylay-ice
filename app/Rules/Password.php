<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Password implements Rule
{
    public function passes($attribute, $value): bool
    {
        // Only allow characters from ASCII 33 to 126 (! to ~), which excludes space (ASCII 32) and any Unicode characters
        return preg_match('/^[\x21-\x7E]+$/', $value);
    }

    public function message(): string
    {
        return __('validation.custom.invalid_password');
    }
}
