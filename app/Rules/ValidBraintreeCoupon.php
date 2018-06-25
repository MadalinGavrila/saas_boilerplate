<?php

namespace App\Rules;

use Braintree_Discount;
use Illuminate\Contracts\Validation\Rule;

class ValidBraintreeCoupon implements Rule
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
        $coupons = [];

        foreach (Braintree_Discount::all() as $coupon) {
            $coupons[] = $coupon->id;
        }

        if (in_array($value, $coupons)) {
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
        return 'That is not a valid coupon.';
    }
}
