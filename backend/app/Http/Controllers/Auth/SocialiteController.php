<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Tymon\JWTAuth\Facades\JWTAuth;

class SocialiteController extends Controller
{
    // Facebook
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function handleFacebookCallback(Request $request)
    {
        try {
            $user = Socialite::driver('facebook')->stateless()->user();
            $authUser = $this->loginOrCreateAccount($user, 'facebook');
            Auth::login($authUser, true);

             //? Generate JWT token
             $token = JWTAuth::fromUser($authUser);

            //? Redirect to frontend
            //! uncomment for server testing
            //!return redirect()->away('https://staging.emporia.today/?token=' . $authUser->createToken('authToken')->plainTextToken);
            //!return redirect()->away('https://staging.emporia.today/?token=' . $token);

            return redirect()->away('http://127.0.0.1:8000/?token=' . $token);
        } catch (\Exception $e) {
            Log::error('Facebook login error: ' . $e->getMessage());
            //! uncomment for server testing
            //! return redirect()->away('https://staging.emporia.today/login?error=Unable to login using Facebook. Please try again.');

            return redirect()->away('http://127.0.0.1:8000/login?error=Unable to login using Facebook. Please try again.');

        }
    }

    // Google
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->redirect();
    }

    public function handleGoogleCallback(Request $request)
    {
        try {
            $user = Socialite::driver('google')->stateless()->user();
            $authUser = $this->loginOrCreateAccount($user, 'google');
            Auth::login($authUser, true);

             //? Generate JWT token
             $token = JWTAuth::fromUser($authUser);
            
            // Redirect to frontend
            //! uncomment for server testing
            //! return redirect()->away('https://staging.emporia.today/?token=' . $token);
            
            return redirect()->away('http://127.0.0.1:8000/?token=' . $token);

        } catch (\Exception $e) {
            Log::error('Google login error: ' . $e->getMessage());
            return redirect()->away('http://127.0.0.1:8000/login?error=Unable to login using Google. Please try again.');

            //! uncomment for server testing
            //! return redirect()->away('https://staging.emporia.today/login?error=Unable to login using Google. Please try again.');

        }
    }

    protected function loginOrCreateAccount($providerUser, $provider)
    {
        $user = User::updateOrCreate([
            'provider_id' => $providerUser->getId(),
            'provider' => $provider,
        ], [
            'first_name' => $providerUser->getName(),
            'email' => $providerUser->getEmail(),
        ]);

        return $user;
    }
}
