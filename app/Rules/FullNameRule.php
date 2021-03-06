<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang;

class FullNameRule implements Rule
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
        if(!preg_match('/^[a-zA-Z]+(?:\s[a-zA-Z]+)+$/', $value)){
            return false;
        }
        
        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('Enter the full name of the new user');
    }
}
