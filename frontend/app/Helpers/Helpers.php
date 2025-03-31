<?php

namespace App\Helpers;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Http;

class Helpers
{
    public static function validateUserToken()
    {
        // Retrieve token from session storage
        $token = Session::get('_token');

        if ($token) {
            // Make request to backend API to validate token
            $response = Http::withToken($token)
                            ->get('http://127.0.0.1:8008/api/auth/validate_token');

            // Handle response
            if ($response->successful()) {
                // Token is valid
                return $response + $token;
            } else {
                // Token is invalid, handle accordingly
                // For example, redirect user to login page
                return redirect()->route('login/token/invalid');
            }
        } else {
            // Token not found in session, handle accordingly
            // For example, redirect user to login page
            return redirect()->route('login');
        }
    }
}
