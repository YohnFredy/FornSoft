<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\Http;

class Recaptcha implements ValidationRule
{
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {

        $response = Http::asForm()->post('https://www.google.com/recaptcha/api/siteverify', [
            'secret'   => config('services.recaptcha.secret'), // mejor usar .env
            'response' => $value,
        ])->object();


        if (!($response->success ?? false) || ($response->score ?? 0) < 0.7) {
            $fail('La verificación de ReCaptcha ha fallado.');  
        }
    }
}
