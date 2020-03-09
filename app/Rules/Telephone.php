<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Telephone implements Rule
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
    public function passes($attribute, $telephone)
    {
        if (preg_match("#^0[1-8]([-. ]?[0-9]{2}){4}$#", $telephone))
        {
            $meta_carac = array("-", ".", " ");
            $telephone = str_replace($meta_carac, "", $telephone);
            $telephone = chunk_split($telephone, 2, "\r");
            return $telephone;
        }
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'The validation error message.';
    }
}
