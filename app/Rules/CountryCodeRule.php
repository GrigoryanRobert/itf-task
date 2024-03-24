<?php

namespace App\Rules;

use App\Services\ApiGuzzelRequests;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class CountryCodeRule implements ValidationRule
{

    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        //
        $url = "http://country.io/continent.json";
        $response = ApiGuzzelRequests::guzzel_get_requests($url);
        if (!array_key_exists($value, $response)) {
            $fail("The Country Code is wrong.");
        }
    }
}
