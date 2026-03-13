<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

/**
 * Validate that a value is numeric and has at most two decimal places.
 *
 * Examples that pass: 10, "10", "10.5", "10.55"
 * Examples that fail: "10.555", "abc", "10."
 */
class TwoDecimal implements Rule
{
    /**
     * Determine if the validation rule passes (string/regex version).
     *
     * Accepts integers or decimals with 1–2 digits after the dot.
     * Disallows trailing dot or more than 2 decimals.
     */
    public function passes($attribute, $value): bool
    {
        if (!is_numeric($value)) {
            return false;
        }

        // Cast to string to validate the textual form
        $str = (string) $value;

        // Allow "10", "10.5", "10.55" (optional decimal part of 1–2 digits)
        return preg_match('/^\d+(\.\d{1,2})?$/', $str) === 1;
    }

    /**
     * Get the validation error message.
     *
     * @return string The translated error message.
     */
    public function message(): string
    {
        return __('validation.custom.invalid_viss');
    }
}
