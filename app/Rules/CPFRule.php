<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use Lang;

class CPFRule implements Rule
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
         * Get only numbers
         * 
         */
        $cpf = preg_replace( '/[^0-9]/is', '', $value);
        
        /**
         * Verify if the string has
         * 11 caracters
         * 
         */
        if (strlen($cpf) != 11) {
            return false;
        }

        /**Verify if the data is like
         * Ex: 111.111.111-11
         * 
         */
        if (preg_match('/(\d)\1{10}/', $cpf)) {
            return false;
        }

        /**
         * Validate with math
         * 
         */
        for ($t = 9; $t < 11; $t++) {
            for ($d = 0, $c = 0; $c < $t; $c++) {
                $d += $cpf{$c} * (($t + 1) - $c);
            }
            $d = ((10 * $d) % 11) % 10;
            if ($cpf{$c} != $d) {
                return false;
            }
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
        return Lang::get('Enter a valid CPF');
    }
}
