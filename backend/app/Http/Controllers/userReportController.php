<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use App\Models\user_report;
use App\Models\user_role;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class userReportController extends Controller
{
    public function store(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'tittle'=> 'required|string',
            'user_description' => 'required|string', 
            'status' => 'nullable|string',
            'assignee' => 'nullable|string',
            'admin_report' => 'nullable|string',
            'free_ad_id' => 'required|exists:free_ads,id'


        ]);

        
        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            
            $userReport = new user_report(); 
            $userReport->tittle = $request->tittle;
            $userReport->user_description = $request->user_description;
            $userReport->assignee = $request->assignee;
            $userReport->admin_report = $request->admin_report;
            $userReport->free_ad_id = $request->free_ad_id;
            $userReport->type = 'free ad report';
            $userReport->user_id = $user->id;
            $userReport->save();
            
        // Return a success response
            return response()->json(['message' => 'Ad Reported successfully', 'data' => $userReport], 201);

        } catch (\Exception $e) {
            // Return an error response if something goes wrong
            return response()->json(['message' => 'Ad Reported failed', 'error' => $e->getMessage()], 500);
        }
    }
    
    public function getReports(Request $request)
    {
        try {
            $status = $request->query('status'); 
    
            $query = user_report::query();
            if (!empty($status)) {
                $query->where('status', $status);
            }
    
            $reports = $query->orderBy('created_at', 'desc')->where('type','free ad report')->paginate(6);
    
            
            foreach ($reports as $report) {
                if ($report->assignee) {
                    $assignee = User::find($report->assignee);
                    $report->assignee_info = $assignee; 
                } else {
                    $report->assignee_info = null; 
                }
            }
    
            return response()->json([
                'message' => 'Reports retrieved successfully',
                'data' => $reports,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving reports',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }
    

    public function getAdsById($id){
        $report = user_report::where('id',$id)->first();
        if($report){
            $reportUser = User::where('id',$report->user_id)->first();
            return response()->json(['message'=>'Report retrieved.','report'=>$report,'user'=>$reportUser,'status'=>200]);
        }else{
            return response()->json(['message'=>'Report not found.','status'=>401]);
        }
    }

    public function submitSupportRequest(Request $request)
    {
        $user = Auth::user();

        if (!$user) {
            return response()->json(['message' => 'Unauthorized'], 401);
        }

        $validator = Validator::make($request->all(), [
            'tittle'=> 'required|string',
            'description' => 'required|string',
        ]);

        if($validator->fails()){
            return response()->json(['message' => $validator->errors()->toJson()], 400);
        }

        try {
            $userReport = new user_report(); 
            $userReport->tittle = $request->tittle;
            $userReport->user_description = $request->description;
            $userReport->type = 'support request';
            $userReport->user_id = $user->id;
            $userReport->save();
            
            return response()->json(['message' => 'Support request submitted successfully', 'data' => $userReport,'status'=>200]);

        } catch (\Exception $e) {
            return response()->json(['message' => 'Support request submission failed', 'error' => $e->getMessage(),'status'=>500]);
        }

    }

    public function getUserReports(Request $request)
    {
        try {
            $status = $request->query('status'); 
    
            $query = user_report::query();
            if (!empty($status)) {
                $query->where('status', $status);
            }
    
            $reports = $query->orderBy('created_at', 'desc')->where('type','support request')->paginate(6);
    
            
            foreach ($reports as $report) {
                if ($report->assignee) {
                    $assignee = User::find($report->assignee);
                    $report->assignee_info = $assignee; 
                } else {
                    $report->assignee_info = null; 
                }
            }
    
            return response()->json([
                'message' => 'Reports retrieved successfully',
                'data' => $reports,
                'status' => 200
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving reports',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }

}

