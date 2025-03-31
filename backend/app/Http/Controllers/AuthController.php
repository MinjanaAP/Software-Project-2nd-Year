<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Mail\forgotPassword;
use App\Mail\VerifyEmail;
use Illuminate\Http\Request;
use Illuminate\Contracts\Auth\Factory;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;
use PhpParser\Node\Stmt\TryCatch;

class AuthController extends Controller
{
    public function _construct(){
        $this->middleware('auth:api', ['except' => ['login','register']]);
    }

    public function register(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string',
            'last_name' => 'string',
            'town' => 'string',
            'district' => 'string',
            'telephone_no_1' => ['required', 'string','unique:users', 'regex:/^(?:\+?94|0)(?:[1-9]\d?|7\d)\d{7}$/'],
            'telephone_no_2' => 'string',
            'email' => 'required|string|email|unique:users|min:6|max:50',
            'password' => 'required|string|confirmed|min:6|max:50',
        ]);
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }
        $user = User::create(array_merge(
            $validator->validated(),
            ['password' => bcrypt($request->password)]
        ));
        return response()->json(['message' => 'User successfully registered', 'user' => $user,'status'=>201]);
    }

    public function login(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:50',
            'password' => 'required|string|min:6'
        ]);
        
        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 422);
        }
        if(!$token = auth()->attempt($validator->validated())){
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $this->createNewToken($token);
    }

    public function createNewToken($token){
        return response()->json([
            'access_token' => $token,
            'token_type'=> 'JWT',
            'expires_in' => Auth::factory()->getTTL() * 120,
            'user' => auth()->user(),      
        ]);
    }

    public function profile(){
        return response()->json(auth()->user());
    }

    public function logout(){
        auth()->logout();
        return response()->json(['message' => 'User successfully logged out']);
    }

    public function forgotPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'email' => 'required|email|max:50',
        ]);
        if ($validator->fails()) {
            return response()->json([
                'status' => 400,
                'message' => $validator->errors()->first(), 
            ]);
        }
        
        else{
            try{
                $token = Str::uuid();
            $user = DB::table('users')->where('email',$request->email)->first();
            $details = [
                //'body' => 'http://127.0.0.1:8000/emailRecovery?email=' . urlencode($request->email) . '&token=' . $token
                'email' => $request->email,
                'token' => $token
            ];

            if($user){
                User::where('email',$request->email)->update([
                    'token'=> $token,
                    'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString()
                ]);

                Mail::to($request->email)->send(new forgotPassword($details));
                return response()->json([
                    'status'=> 200,
                    'messages' => 'Reset password link has been sent to your e-mail!'
                ]);
            }else{
                return response()->json([
                    'status' => 401,
                    'messages' => 'This email address is not registered with us! '
                ]);
            }

            }catch(\Exception $e){
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }
    }

    //password reset
    public function resetPassword(Request $request){
        $validator = Validator::make($request->all(),[
            'new_password' => 'required|string|min:6|max:50',
            'confirm_password' => 'required|string|same:new_password'
        ]);

        if($validator->fails()){
            return response()->json([
                'status' => 400,
                'messages' => $validator->errors()->first()
            ]);
        }
        else{
            try {
                $user = DB::table('users')->where('email',$request->email)->whereNotNull('token')->where('token',$request->token)->where('token_expire','>',Carbon::now())->exists();
                if($user){
                    User::where('email',$request->email)->update([
                        'password' => bcrypt($request->new_password),
                        'token' => null,
                        'token_expire' => null
                    ]);
                    return response()->json([
                        'status'=> 200,
                        'messages' => 'Password reset successfully!'
                    ]);
                }
                else{
                    return response()->json([
                        'status'=> 401,
                        'messages' => 'Request link has been expired!'
                    ]);
                }
            } catch (\Exception $e) {
                return response()->json([
                    'status'=> 500,
                    'messages' => $e->getMessage()
                ]);
            }
        }
    }

    //?check user Authentication
    public function checkTokenValidity(Request $request)
    {
        $user = auth()->user();
    
        if ($user) {
            // Token is valid, user is authenticated
            return response()->json(['message' => 'Token is valid', 'user' => $user], 200);
        } else {
            // Token is invalid or user is not authenticated
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // if ($request->user() && $request->bearerToken()) {
        //     // Token is valid, user is authenticated
        //     return response()->json(['message' => 'Token is valid', 'user' => $user], 200);
        // } else {
        //     // Token is invalid or user is not authenticated
        //     return response()->json(['error' => 'Unauthorized'], 401);
        // }

        // var_dump($request->user());
        // var_dump($request->bearerToken());
        // var_dump($request);
    }

    public function editUserDetails(Request $request){
        $user = Auth::user();
        if($user){
            $validator = Validator::make($request->all(),[
                'last_name' => 'required|string',
                'town' => 'required|string',
                'district' => 'required|string',
                'profile_image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048'
            ]);
    
            if($validator->fails()){
                return response()->json($validator->errors()->toJson(), 400);
            } else {
                try{
                    $editUser = User::findOrFail($user->id);
    
                    // Handle profile image upload
                    if($request->hasFile('profile_image')) {
                        $image = $request->file('profile_image');
                        $path = Storage::disk('s3')->put('images', $image);
                        $url = Storage::disk('s3')->url($path);
                        $editUser->profile_image = $url;
                    }
    
                    // Update user details
                    $editUser->last_name = $request->input('last_name');
                    $editUser->town = $request->input('town');
                    $editUser->district = $request->input('district');
                    $editUser->save();
    
                    return response()->json(['message' => 'Account updated successfully', 'status' => 201, 'user' => $editUser]);
                } catch (\Exception $e) {
                    return response()->json(['message' => $e->getMessage(), 'status' => 409]);
                }
            }
        } else {
            return response()->json(['message' => 'User not found', 'status' => 409]);
        }
    }
    
    //delete user
    public function deleteUser(){

        $user = Auth::user();

        if (!$user) {
            return response()->json([
                'status' => 400,
                'message' => 'User not found', 
            ]);
        }
        else{
            try{
                $user = DB::table('users')->where('email',$user->email)->first();
                if($user){
                    User::where('email',$user->email)->delete();
                    return response()->json([
                        'status'=> 200,
                        'messages' => 'User deleted successfully!'
                    ]);
                }else{
                    return response()->json([
                        'status' => 401,
                        'messages' => 'This email address is not registered with us! '
                    ]);
                }
            }catch(\Exception $e){
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage()
                ]);
            }
        }
    }

    public function sendVerificationEmail(Request $request){
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'status' => 401,
                'message' => 'Unauthorized',
            ], 401);
        }
    
        try {
            $token = Str::uuid();
            $details = [
                'email' => $user->email,
                'token' => $token
            ];
    
            User::where('email', $user->email)->update([
                'token' => $token,
                'token_expire' => Carbon::now()->addMinutes(10)->toDateTimeString()
            ]);
    
            Mail::to($user->email)->send(new VerifyEmail($details));
            return response()->json([
                'status' => 200,
                'message' => 'Verification link has been sent to your email!'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage()
            ]);
        }
    }

    public function verifyEmail(Request $request){
        try {
            $user = User::where('token', $request->token)->first();
    
            if ($user && Carbon::now()->lessThanOrEqualTo($user->token_expire)) {
                $user->update([
                    'email_verified_at' => now(),
                    'token' => null,
                    'token_expire' => null,
                    'status'=> 'verify'
                ]);
    
                $frontendUrl = env('APP_STAGING_URL');
                return redirect()->away("$frontendUrl/login?status=success&message=Email verified successfully.");
            } else {
                $frontendUrl = env('APP_STAGING_URL');
                return redirect()->away("$frontendUrl/my/profile?status=error&message=Invalid or expired token.");
            }
        } catch (\Exception $e) {
            $frontendUrl = env('APP_STAGING_URL');
            return redirect()->away("$frontendUrl/my/profile?status=error&message=An error occurred while verifying your email.");
        }
    }
    
    
}
