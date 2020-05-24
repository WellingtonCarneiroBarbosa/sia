<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang;

class EmailDomainRule implements Rule
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
        $extension = explode("@", $value);

        if($extension[1] != "fiepr.org.br"){
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
        return Lang::get('The email domain must be @ fiepr.org.br');
    }
}
