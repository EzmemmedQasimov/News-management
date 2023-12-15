<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class ValidLanguageRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $supportedLanguages = config('custom.supported_langauges');

        if (!in_array($value, $supportedLanguages)) {
            $fail('The :attribute is not supported.');
        }
    }
}
