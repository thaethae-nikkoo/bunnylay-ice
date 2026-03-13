<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Username implements Rule
{
    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        // Define the regex pattern for username (letters, numbers, underscore)
        $pattern = '/^[a-zA-Z0-9_]+$/';

        // Check if the username matches the pattern and does not contain spaces
        return preg_match($pattern, $value) && !preg_match('/\s/', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('validation.custom.username'); 
    }
}
