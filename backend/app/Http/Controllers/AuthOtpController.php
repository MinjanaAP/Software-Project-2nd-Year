<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\VerificationCode;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Twilio\Rest\Client;
use Illuminate\Support\Facades\Http;

class AuthOtpController extends Controller
{
    // public function generate(Request $request)
    // {
    //     $sid = config('services.twilio.sid');
    //     $token = config('services.twilio.token');
    //     $serviceId = config('services.twilio.service_id');
    //     $twilio = new Client($sid, $token);
    //     // Validate data
    //     $validator = Validator::make($request->all(), [
    //         'mobile_no' => 'required|exists:users,telephone_no_1|numeric|digits:10'
    //     ]);

    //     if ($validator->fails()) {
    //         return response()->json(['message' => $validator->errors()->first()], 401);
    //     }

    //     // $validation_request = $twilio->validationRequests
    //     //                      ->create("+94725304825", // phoneNumber
    //     //                             ["friendlyName" => "My Home Phone Number"]
    //     //                     );

    //     // Generate OTP
    //    // $verificationCode = $this->generateOtp($request->mobile_no);

    //     // Send OTP using Twilio
    //     try {
            

    //         $twilio->verify->v2->services($serviceId)
    //             ->verifications
    //             ->create("+94716088647", 'sms');

    //         return response()->json(['message' => 'OTP generated successfully', 'status' => 200]);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Failed to send OTP', 'error' => $e->getMessage()], 500);
    //     }
    // }

    public function generate(Request $request) {
        $validator = Validator::make($request->all(), [
            'mobile_no' => 'required|exists:users,telephone_no_1|numeric|digits:10'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->first()], 401);
        }
    
        $verificationCode = $this->generateOtp($request->mobile_no);

        $phoneNumber = $request->mobile_no;
        $phoneNumber = trim($phoneNumber);
        if (preg_match('/^0\d{9}$/', $phoneNumber)) {
            $convertedPhoneNumber = '94' . substr($phoneNumber, 1);
        } else {
            return response()->json(['error' => 'Invalid phone number format'], 400);
        }

    
        if ($verificationCode) {
            $user_id = 27364;
            $api_key = '94ree6YTSTJl1knYTv57';
            $sender_id = 'NotifyDEMO';
            $to = $convertedPhoneNumber; 
            $message = 'Your OTP is: ' . $verificationCode->otp;
            $url = 'https://app.notify.lk/api/v1/send';
    
            
            $response = Http::get($url, [
                'user_id' => $user_id,
                'api_key' => $api_key,
                'sender_id' => $sender_id,
                'to' => $to, 
                'message' => $message
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'OTP generated and sent successfully', 'data' => $verificationCode, 'status' => 200]);
            } else {
                return response()->json(['message' => 'Failed to send OTP', 'data' => $response->body()], 500);
            }
        }
    
        return response()->json(['message' => 'Failed to generate OTP'], 500);
    }

    private function generateOtp($mobile_no) {
    
        $user = User::where('telephone_no_1', $mobile_no)->first();

        
        $now = Carbon::now();
        $verificationCode = VerificationCode::where('user_id', $user->id)->latest()->first();

        if ($verificationCode && $now->isBefore($verificationCode->expire_at)) {
            return $verificationCode;
        }

        $otp = rand(100000, 999999);
        return VerificationCode::create([
            'user_id' => $user->id,
            'otp' => $otp,
            'expire_at' => $now->addMinutes(5)
        ]);
    }

    public function convertPhoneNumber(Request $request)
    {
        $phoneNumber = $request->input('phone_number');

        $phoneNumber = trim($phoneNumber);

        if (preg_match('/^0\d{9}$/', $phoneNumber)) {
            
            $convertedPhoneNumber = '94' . substr($phoneNumber, 1);
        } else {
            return response()->json(['error' => 'Invalid phone number format'], 400);
        }

        // Return the converted phone number
        return response()->json(['converted_phone_number' => $convertedPhoneNumber]);
    }


public function loginWithOtp(Request $request) {
    // Validate request data
    $validator = Validator::make($request->all(), [
        'user_id'=>'required|exists:users,id',
        // 'mobile_no' => 'required|exists:users,telephone_no_1|numeric|digits:10',
        'otp' => 'required|numeric|digits:6'
    ]);

    if ($validator->fails()) {
        return response()->json(['message' => $validator->errors()->first()], 401);
    }

    // Get user
    // $user = User::where('telephone_no_1', $request->mobile_no)->first();
    $user = User::where('id', $request->user_id)->first();

    // Check OTP
    $now = Carbon::now();
    $verificationCode = VerificationCode::where('user_id', $user->id)->where('otp', $request->otp)->first();

    if (!$verificationCode) {
        return response()->json(['message' => 'OTP is not correct.'], 401);
    } elseif ($now->isAfter($verificationCode->expire_at)) {
        return response()->json(['message' => 'OTP expired'], 401);
    }

    // Expire the OTP
    $verificationCode->update(['expire_at' => $now]);

    // Generate JWT token
    if (!$token = auth()->login($user)) {
        return response()->json(['message' => 'Unauthorized'], 401);
    }

    return $this->createNewToken($token);
}

public function createNewToken($token) {
    return response()->json([
        'access_token' => $token,
        'token_type' => 'JWT',
        'expires_in' => Auth::factory()->getTTL() * 60,
        'user' => auth()->user(),
        'status'=> 200
    ]);
}
}
