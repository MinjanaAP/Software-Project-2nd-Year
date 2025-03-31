<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GoogleAuthController extends Controller
{
    public function redirect(){
        return Socialite::driver('google')->redirect();
    }

    public function callbackGoogle(){
        try {
            $googleUser = Socialite::driver('google')->user();
            // dd($googleUser);
            //? check if user exists in db
            $user = User::where('google_id',$googleUser->getId())->first();

            if(!$user){
                $newUser = User::create([
                    'first_name'=> $googleUser->getName(),
                    'email'=> $googleUser->getEmail(),
                    'google_id'=> $googleUser->getId(),
                ]);

                Auth::login($newUser);
                return redirect()->intended('http://127.0.0.1:8000/createAccmain');
            }else{
                Auth::login($user);
                return redirect()->intended('http://127.0.0.1:8000/createAccmain?');
            }

        } catch (\Throwable $th) {
            return response()->json([
                'message' =>  $th->getMessage()
            ]);
        }
    }
}
