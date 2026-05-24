<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\CreatesNewUsers;
use Laravel\Jetstream\Jetstream;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'first_name' => ['required', 'string', 'max:255'],
            'last_name'  => ['required', 'string', 'max:255'],
            
            // EMAIL: Accepts gmail.com OR rub.edu.bt
            'email' => [
                'required', 
                'string', 
                'email', 
                'max:255', 
                'unique:users', 
                'regex:/^[a-zA-Z0-9._%+-]+@(gmail\.com|rub\.edu\.bt)$/i'
            ],

            // PHONE: Strict length validation for all countries
            'phone_number' => [
                'required',
                'numeric',
                function ($attribute, $value, $fail) use ($input) {
                    // Define exact lengths for each country code
                    $lengths = [
                        "975" => 8,  // Bhutan
                        "91"  => 10, // India
                        "977" => 10, // Nepal
                        "880" => 10, // Bangladesh
                        "1"   => 10, // USA/Canada
                        "44"  => 10, // UK
                        "61"  => 9,  // Australia
                        "65"  => 8,  // Singapore
                        "66"  => 9,  // Thailand
                        "60"  => 9,  // Malaysia
                        "94"  => 9,  // Sri Lanka
                        "960" => 7,  // Maldives
                        "81"  => 10, // Japan
                        "82"  => 10, // South Korea
                        "971" => 9,  // UAE
                    ];

                    $code = $input['country_code'];
                    $actualLength = strlen($value);

                    // Check if the country code exists in our restriction list
                    if (array_key_exists($code, $lengths)) {
                        $expected = $lengths[$code];
                        if ($actualLength != $expected) {
                            $fail("The phone number for this country must be exactly {$expected} digits.");
                        }
                    } else {
                        // Default fallback for any country not in the list (standard international range)
                        if ($actualLength < 7 || $actualLength > 15) {
                            $fail("Please enter a valid phone number length.");
                        }
                    }
                },
            ],

            'password' => $this->passwordRules(),
            'terms' => Jetstream::hasTermsAndPrivacyPolicyFeature() ? ['accepted', 'required'] : '',
        ], [
            // Custom error messages
            'email.regex' => 'Registration is only allowed with @gmail.com or @rub.edu.bt emails.',
            'phone_number.numeric' => 'The phone number must contain only numbers.',
        ])->validate();

        return User::create([
            'first_name' => $input['first_name'],
            'last_name'  => $input['last_name'],
            'email'      => $input['email'],
            // Saves to DB as +97517XXXXXX
            'phone'      => '+' . $input['country_code'] . $input['phone_number'], 
            'usertype'   => '0',
            'password'   => Hash::make($input['password']),
        ]);
    }
}