<?php

namespace App\Rules;
use Carbon\Carbon;

use Illuminate\Contracts\Validation\Rule;

class ValidDate implements Rule
{
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        return preg_match('([12]\d{3}-(0[1-9]|1[0-2])-(0[1-9]|[12]\d|3[01]))', $value);
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return __('Please enter a valid date.');
    }
}
