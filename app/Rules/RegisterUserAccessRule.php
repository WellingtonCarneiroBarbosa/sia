<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang;

class RegisterUserAccessRule implements Rule
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
        if($value == 3 || $value == 5)
        {
            return true;
        }
        
        return false;
    }   

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return Lang::get('Only the registration of users and administrators is allowed');
    }
}
