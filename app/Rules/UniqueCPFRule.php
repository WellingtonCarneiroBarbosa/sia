<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;
use App\User;
use Lang;

class UniqueCPFRule implements Rule
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
        $cpf = User::where('cpf', $value)->where('id', '!=', auth()->user()->id)->take(1)->get();

        if(count($cpf) > 0 ) {
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
        return Lang::get('This CPF is already registered in the system. If you believe this is a mistake, contact') . " " . config('mail.from.address');
    }
}
