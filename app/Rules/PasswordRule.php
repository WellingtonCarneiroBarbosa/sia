<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang;

class PasswordRule implements Rule
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
        /**
         * Minimum of eight characters, at least one
         * uppercase letter, one lowercase letter and
         * one number     
         * 
         */
        if(!preg_match("/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d){8,18}$/", $value)){
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
        return Lang::get('Your password must contain lowercase and uppercase characters and numbers');
    }
}
