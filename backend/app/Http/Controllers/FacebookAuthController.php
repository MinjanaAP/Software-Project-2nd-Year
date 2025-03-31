<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class FacebookAuthController extends Controller
{
    public function redirect(){
        
        return Socialite::driver('facebook')->redirect();
    }

    public function callBackFacebook(){
        try{
            $facebookUser = Socialite::driver('facebook')->user();
            dd($facebookUser);
            //? check if user exists in db
            // $user = User::where('facebook_id',$facebookUser->getId())->first();

            // if(!$user){
            //     $newUser = User::create([
            //         'first_name'=> $facebookUser->getName(),
            //         'email'=> $facebookUser->getEmail(),
            //         'facebook_id'=> $facebookUser->getId(),
            //     ]);

            //     Auth::login($newUser);
            //     return redirect()->intended('/home');
            // }
        }catch(\Throwable $th){
            return response()->json([
                'message' => $th->getMessage()
            ]);
        }
    }


}
