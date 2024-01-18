<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class EmailCompanyFormat implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $pairs = explode(',', $value);

        foreach ($pairs as $pair) {
            $parts = explode('-', $pair);

            if (count($parts) != 2) {
                $fail("The $attribute format is invalid for the pair '$pair'.");

                return;
            }

            [$email, $company] = $parts;

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                $fail("The email '$email' in the $attribute is not a valid email address.");

                return;
            }
        }
    }
}
