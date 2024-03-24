<?php

namespace App\Rules;

use App\Services\ApiGuzzelRequests;
use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class TimeZoneRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $url = "http://worldtimeapi.org/api/timezone";
        $response = ApiGuzzelRequests::guzzel_get_requests($url);
        if (!in_array($value, $response)) {
            $fail("The Time Zone Name is wrong.");
        }
    }
}
