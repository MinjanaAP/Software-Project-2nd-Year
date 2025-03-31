<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\bargain_ads;
use App\Models\free_ad;
use App\Models\User;
use App\Models\paid_ad;
use App\Models\sub_categories;
use App\Models\user_notification;
use App\Models\user_report;
use Illuminate\Support\Facades\Validator;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Twilio\Rest\Serverless\V1\Service\TwilioFunction\FunctionVersionList;

use function Psy\debug;

class AdminDashboardController extends Controller
{
    public function getNumberOfUsers(){
        return User::count();
    }

    public function getNumberOffree_ads(){
        return free_ad::count();
    }

    public function getNumberOfPaidAds(){
        return paid_ad::count();
    }

    //TODO: Implement this function
    public function getNumberOfBargainAds(){
        return bargain_ads::count();
    }

    public function getCounts(){
        return response()->json([
            'users' => $this->getNumberOfUsers(),
            'free_ads' => $this->getNumberOffree_ads(),
            'paid_ads' => $this->getNumberOfPaidAds(),
            'bargain_ads' => $this->getNumberOfBargainAds()
        ]);
    }

    public function getLatestAccountCreationDates()
{
    
    $latestAccountCreationDates = User::selectRaw('DATE(created_at) as creation_date, COUNT(*) as account_count')
        ->groupBy('creation_date')
        ->orderByDesc('creation_date')
        ->limit(7)
        ->get();

    
    $freeAdCreationDates = free_ad::selectRaw('DATE(created_at) as creation_date, COUNT(*) as free_ad_count')
        ->groupBy('creation_date')
        ->orderByDesc('creation_date')
        ->limit(7)
        ->get();

    $dates = [];
    $counts = [];
    $freeAdDates = [];
    $freeAdCounts = [];

    
    foreach ($latestAccountCreationDates as $entry) {
        $dates[] = $entry->creation_date;
        $counts[] = $entry->account_count;
    }

    
    foreach ($freeAdCreationDates as $freeAd) {
        $freeAdDates[] = $freeAd->creation_date;
        $freeAdCounts[] = $freeAd->free_ad_count;
    }

    
    $dates = array_reverse($dates);
    $counts = array_reverse($counts);
    $freeAdDates = array_reverse($freeAdDates);
    $freeAdCounts = array_reverse($freeAdCounts);

    return response()->json([
        'dates' => $dates,
        'counts' => $counts,
        'freeAdDates' => $freeAdDates,
        'freeAdCounts' => $freeAdCounts
    ]);
}


    //? Get user details to Admin Panel

    public function getUserDetails(){
        $users = User::selectRaw('status, COUNT(*) as user_count')
            ->groupBy('status')
            ->where('role', 'user')
            ->get();

        return response()->json([
            'users' => $users
        ]);
    }

    //?get admin panel users
    public function getAdminUsers(){
        $users = User::whereIn('role', ['admin'])->get();

        return response()->json([
            'users' => $users
        ]);
    }

    public function deleteAdminUser(Request $request){
        $user = User::where('id',$request->id)->first();
        if(!$user){
            return response(['message'=>'user not found.','status'=>409]);
        }

        try {
            $user->delete();
            return response(['message'=>'user account delete successfully','status'=>200]);
        
        } catch (\Exception $e) {
            return response(['message'=>$e->getMessage(),'status'=>401]);
        }


    }

    //?create Admin users
    public function createAdminUser(Request $request){
        $validator = Validator::make($request->all(),[
            'first_name' => 'required|string|min:3|max:50',
            'email' => 'required|string|email|unique:users|min:6|max:50',
            'password' => 'required|string|min:6|max:50',
            'role'=> 'required'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $user = User::create(array_merge(
            $validator->validated(),
            ['password'=> bcrypt($request->password)]
        ));
        return response()->json(['message' => 'User successfully registered', 'user' => $user], 201);
    }

    //?GET method to fetch the last 7 days ads
    public function getLast7DaysAds()
    {
        $today = Carbon::today();
        $dates = [];
        $adsCount = [];

        for ($i = 0; $i < 7; $i++) {
            $date = $today->copy()->subDays($i)->format('Y-m-d');
            $dates[] = $date;
            $adsCount[] = free_ad::whereDate('created_at', $date)->count();
        }

        return response()->json([
            'dates' => array_reverse($dates),
            'adsCount' => array_reverse($adsCount),
        ]);
    }

    //?GET ads status count
    public function getAdsStatusCount()
    {
        $statusCounts = free_ad::selectRaw('status,count(*) as count')
                            ->groupBy('status')
                            ->get()
                            ->pluck('count', 'status');

        return response()->json($statusCounts);
    }

    public function getLiveAds()
    {
        $liveAds = free_ad::orderBy('created_at', 'desc')->where('status', 'live')->take(5)->get();
        return response()->json($liveAds);
    }

    public function getBlockedAds()
    {
        $blockedAds = free_ad::orderBy('created_at', 'desc')->where('status', 'blocked')->take(5)->get();
        return response()->json($blockedAds);
    }

    public function getPendingAds()
    {
        $pendingAds = free_ad::orderBy('created_at', 'desc')->where('status', 'pending')->take(5)->get();
        return response()->json($pendingAds);
    }

    public function getSpecificAds($id)
{
    try {
        $specificAd = free_ad::where('id', $id)
        ->with('user')
        ->firstOrFail();
        
        if (!$specificAd) {
            return response()->json(['message' => 'Ad not found'], 404);
        }

        if ($specificAd->sub_categories === 'Mobile Phones') {
            $specificAdFeatures = DB::table('mobile_phone_features')->where('free_ad_id', $id)->first();
            if ($specificAdFeatures) {
                // Combine the ad and its features
                $specificAd = $specificAd->toArray();
                $specificAdFeatures = (array) $specificAdFeatures; // Convert stdClass to array
                $combinedData = array_merge($specificAd, $specificAdFeatures);
                return response()->json(['message' => 'Ad and features retrieved successfully', 'data' => $combinedData], 200);
            }
        }

        return response()->json(['message' => 'Ad retrieved successfully', 'data' => $specificAd], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Error retrieving ad', 'error' => $e->getMessage()], 500);
    }
}


    public function editFreeAds(Request $request)
    {
        try {
            $request->validate([
                'title' => 'required|string|max:255',
                'price' => 'required|numeric',
                'sub_category' => 'required|string|max:255',
                'category' => 'required|string|max:255',
                'condition' => 'required|string|max:255',
                'brand' => 'required|string|max:255',
                'description' => 'required|string',
                'district' => 'required|string|max:255',
                'town' => 'required|string|max:255',
                'negotiable' => 'required|string',
                'status' => 'required|string|in:pending,live,blocked',
                // Validate images if present
                'image_1' => 'sometimes|url',
                'image_2' => 'sometimes|url',
                'image_3' => 'sometimes|url',
                'image_4' => 'sometimes|url',
                'image_5' => 'sometimes|url',
            ]);
    
            $ad = free_ad::findOrFail($request->id);
            $ad->title = $request->title;
            $ad->price = $request->price;
            $ad->sub_category = $request->sub_category;
            $ad->category = $request->category;
            $ad->condition = $request->condition;
            $ad->brand = $request->brand;
            $ad->description = $request->description;
            $ad->district = $request->district;
            $ad->town = $request->town;
            $ad->negotiable = $request->negotiable;
            $ad->status = $request->status;
    
            // Update image URLs
            $ad->image_1 = $request->image_1 ?? ($request->image_2 ?? ($request->image_3 ?? ($request->image_4 ?? $request->image_5 ?? null)));
            $ad->image_2 = $request->image_2 ?? ($request->image_3 ?? ($request->image_4 ?? $request->image_5 ?? null));
            $ad->image_3 = $request->image_3 ?? ($request->image_4 ?? $request->image_5 ?? null);
            $ad->image_4 = $request->image_4 ?? ($request->image_5 ?? null);
            $ad->image_5 = $request->image_5 ?? null;
    
            $ad->save();
            return response()->json(['message' => 'Record updated successfully', 'data' => $ad ,'status'=>201]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 409]);
        }
    }

    public function getPaidAds(){
        try {
            $paidAds = DB::table('paid_ads')
                ->select('paid_ads.*')
                ->join(DB::raw('(SELECT MAX(id) as max_id FROM paid_ads GROUP BY paid_ad_type) as grouped_paid_ads'), function($join) {
                    $join->on('paid_ads.id', '=', 'grouped_paid_ads.max_id');
                })
                ->orderBy('created_at', 'desc')
                ->get();
    
            return response()->json(['message' => 'Record retrieval successfully', 'data' => $paidAds], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }
    

    public function getAdsByStatus($status){
        $baseUrl = env('APP_BASE_URL');
        $ads = free_ad::where('status', $status)->paginate(10)->withPath($baseUrl.'/api/admin/getAllAdsByStatus/'.$status);
        if($ads->isEmpty()){
            return response()->json(['message' => 'Ads not found', 'status' => 404]);
        }
        return response()->json(['message' => 'Ads retrieved successfully', 'data' => $ads, 'status' => 200]);
    }

    //todo: Implement this function
    public function getAdsByCategory($subcategory){
        $ads = free_ad::where('sub_category', $subcategory)->paginate(10);
        if($ads->isEmpty()){
            return response()->json(['message' => 'Ads not found', 'status' => 404]);
        }
        return response()->json(['message' => 'Ads retrieved successfully', 'data' => $ads, 'status' => 200]);
    }

    //todo: Implement this function
    public function getAdsByDistrict($district){
        $ads = free_ad::where('district', $district)->paginate(10);
        if($ads->isEmpty()){
            return response()->json(['message' => 'Ads not found', 'status' => 404]);
        }
        return response()->json(['message' => 'Ads retrieved successfully', 'data' => $ads, 'status' => 200]);
    }

    //todo: Implement this function
    public function getAdsByTown($town){
        $ads = free_ad::where('town', $town)->paginate(10);
        if($ads->isEmpty()){
            return response()->json(['message' => 'Ads not found', 'status' => 404]);
        }
        return response()->json(['message' => 'Ads retrieved successfully', 'data' => $ads, 'status' => 200]);
    }

    public function getUserByStatus($status){
        $baseUrl = env('APP_BASE_URL');
        $users = User::orderBy('created_at', 'desc')->where('status', $status)->where('role','user')->paginate(10)->withPath($baseUrl.'/api/admin/getUserByStatus/'.$status);
        if($users->isEmpty()){
            return response()->json(['message' => 'Users not found', 'status' => 404]);
        }
        return response()->json(['message' => 'Users retrieved successfully', 'data' => $users, 'status' => 200]);
    }
    
    public function getUserById($id){
        $user = User::where('id', $id)->first();
        if(!$user){
            return response()->json(['message' => 'User not found', 'status' => 404]);
        }
        $freeAds = free_ad::where('user_id', $id)->pluck('id','title')->toArray();
        $bannerAds = paid_ad::where('user_id', $id)->pluck('id','name')->toArray();
        $bargainAds = bargain_ads::where('user_id', $id)->pluck('id','free_ad_id')->toArray();
        return response()->json(['message' => 'User retrieved successfully', 'data' => $user, 'freeAds'=>$freeAds,'bannerAds'=>$bannerAds,'bargainAds'=>$bargainAds, 'status' => 200]);
    }

    public function editUserStatus($id, Request $request)
    {
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['message' => 'Unauthorized', 'status' => 401]);
        }

        $validator = Validator::make($request->all(), [
            'status' => 'required|in:active,verify,banned',
            'reason' => 'required_if:status,banned'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        $user = User::find($id);

        if (!$user) {
            return response()->json(['message' => 'User not found', 'status' => 404]);
        }

        if($request->status == 'banned'){
            try {
                $notification = user_notification::create([
                    'user_id' => $user->id,
                    'title' => 'Account Banned',
                    'message' => $request->reason,
                    'type' => 'admin notification',
                    'admin_id'=> $admin->id,
                    'status'=> 'danger'
                ]);
                $notification->save();
                $user->status = $request->status;
                $user->save();
                return response()->json(['message' => 'User status updated and send notification successfully', 'data' => $user, 'status' => 200]);
            } catch (Exception $e) {
                return response()->json(['message' => $e->getMessage(), 'status' => 500]);
            }
        }

        $user->status =$request->status;
        $user->save();
        return response()->json(['message' => 'User status updated successfully', 'data' => $user, 'status' => 200]);
    }

    public function editFreeAdsStatus(Request $request){
        $admin = Auth::user();
        if (!$admin) {
            return response()->json(['message' => 'Unauthorized', 'status' => 401]);
        }

        $validator = Validator::make($request->all(), [
            'user_id'=>'required|exists:users,id',
            'status' => 'required|in:pending,live,blocked',
            'title'=>'required|string',
            'free_ad_id'=>'required|exists:free_ads,id'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        if($request->status === 'live'){
            $status = 'success';
        }elseif($request->status === 'blocked'){
            $status = 'danger';
        }else{
            $status = 'warning';
        }
        

        $notification = user_notification::create([
            'user_id' => $request->user_id,
            'title' => 'Advertisement Status',
            'message' => 'Your advertisement '.$request->title.' has been '.$request->status,
            'type' => 'admin notification',
            'admin_id'=> $admin->id,
            'status'=> $status,
            'free_ad_id'=>$request->free_ad_id
        ]);
        $notification->save();
        
        
        return response()->json(['message' => 'Notification saved.','data'=>$notification, 'status' => 200]);
    }

    public function assignMe(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json(['message'=>'Unauthorized','status'=>401]);
        }

        $user_report = user_report::find($request->id);
        if($user_report){
        $user_report->assignee = $user->id;
        $user_report->save();
        return response()->json(['message'=>'Report assigned to you','status'=>200]);
        }else{
            return response()->json(['message'=>'Report not found','status'=>404]);
        }
    }

    public function addReportFeedBack(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json(['message'=>'Unauthorized.','status'=>401]);
        }
         $validator = Validator::make($request->all(),[
            'id'=>'required|exists:user_reports,id',
            'status'=> 'required|in:to do,Inprogress,Done',
            'description'=> 'required|string'
         ]);

         if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
         }

        $user_report = user_report::find($request->id);
        if($user_report){
            $user_report->status = $request->status;
        $user_report->admin_report = $request->description;
        $user_report->save();
        return response()->json(['message'=>'report updated','data'=>$user_report,'status'=>200]);
        }else{
            return response()->json(['message'=>'report not found','status'=>404]);       
        }
        
    }

    public function addAdminRequest(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json(['message'=>'Unauthorized','status'=>401]);
        }

        try {
                $user_report = user_report::find($request->id);
            if($user_report){
                $user_report->superAdmin_request = $request->superAdmin_request;
                $user_report->save();
                return response()->json(['message'=>'Request send successfully.','status'=>200]);
            }
            else{
                return response()->json(['report not found','status'=>401]);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>401]);
        }
    }

    public function getAdminTasks(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json(['message'=>'Unauthorized','status'=>401]);
        }

        try {
            $status = $request->query('status'); 
    
            $query = user_report::query();
            if (!empty($status)) {
                $query->where('status', $status);
            }
            
            if ($user->role === 'superAdmin') {
                $assignedReports = $query->orderBy('created_at', 'desc')
                                        ->where('assignee', $user->id)
                                        ->get();
            
                $requestedReports = $query->orderBy('created_at', 'desc')
                                        ->where('superAdmin_request', '!=', null)
                                        ->get();
                $reports = $assignedReports->merge($requestedReports);
                // $reports = [
                //     'assignedReports' => $assignedReports,
                //     'requestedReports' => $requestedReports,
                // ];
            } else {
                
                $reports = $query->orderBy('created_at', 'desc')
                                ->where('assignee', $user->id)
                                ->paginate(6);
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

    public function getPaidAdsDetails(Request $request) {
        $query = paid_ad::orderBy('created_at', 'desc');
    
        if ($request->has('paid_ad_type') && $request->paid_ad_type != '') {
            $query->where('paid_ad_type', $request->paid_ad_type);
        }
    
        $paidAds = $query->paginate(6);
    
        return response()->json([
            'message' => 'Record retrieval successfully',
            'data' => $paidAds,
            'status' => 200
        ]);
    }

    public function getSuperAdminTasks(Request $request){
        $user = Auth::user();
        if(!$user){
            return response()->json(['message'=>'Unauthorized','status'=>401]);
        }

        try {
            if($user->role === 'superAdmin'){
                $assignedReports = user_report::orderBy('created_at', 'desc')
                                        ->where('assignee', $user->id)
                                        ->get();
            
                $requestedReports = user_report::orderBy('created_at', 'desc')
                                        ->where('superAdmin_request', '!=', null)
                                        ->get();
                $reports =$assignedReports->merge($requestedReports) ;
                return response()->json([
                    'message' => 'Reports retrieved successfully',
                    'data' => $reports,
                    'status' => 200
                ]);
            
            }else{
                return response()->json(['message'=>'Unauthorized','status'=>401]);
            }
            
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error retrieving reports',
                'error' => $e->getMessage(),
                'status' => 500
            ], 500);
        }
    }


    public function getSpecificPaidAds($id){
        $paidAd = paid_ad::find($id);
        if($paidAd){
            $user = User::find($paidAd->user_id);
            return response()->json(['message'=>'Paid Ad retrieved.','data'=>$paidAd,'user'=>$user,'status'=>200]);
        }else{
            return response()->json(['message'=>'Paid Ad not found.','status'=>401]);
        }
    }
    
    public function updateBannerAd(Request $request){
        $paidAd = paid_ad::find($request->id);
        if($paidAd){
            $paidAd->status = $request->status;
            $paidAd->save();
            return response()->json(['message'=>'Banner Ad updated.','data'=>$paidAd,'status'=>200]);
        }else{
            return response()->json(['message'=>'Banner Ad not found.','status'=>401]);
        }
    }

    public function addSubCategory(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'features' => 'required|string'
        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(),400);
        }

        $image = $request->file('image');
        $path = Storage::disk('s3')->put('subCategory_images', $image);
        $imageUrl = Storage::disk('s3')->url($path);

        $icon = $request->file('icon');
        $icon_path = Storage::disk('s3')->put('subCategory_icons', $icon);
        $iconUrl = Storage::disk('s3')->url($icon_path);

        $features = explode(',', $request->features);
        array_unshift($features, 'freeAd_id');
        $subCategory = new sub_categories();
        $subCategory->Name = $request->name;
        $subCategory->image_url = $imageUrl;
        $subCategory->icon_url = $iconUrl;
        $subCategory->feature_table = $request->name . '_feature_table';
        $subCategory->brands_table = $request->name . '_brand_table';
        $subCategory->version_table = $request->name . '_version_table';
        $subCategory->save();
        

        // Dynamically create the feature table
        $featureTableName = $subCategory->feature_table;
        DB::statement($this->createFeatureTableQuery($featureTableName, $features));

        // Dynamically create the brand table
        $brandTableName =$request->name . '_brand_table';
        DB::statement($this->createBrandTableQuery($brandTableName));

        // Dynamically create the version table
        $versionTableName = $request->name . '_version_table';
        DB::statement($this->createVersionTableQuery($versionTableName));

        return response()->json(['message' => 'Sub-category created successfully', 'data' => $subCategory,'status'=>200]);
    }

    protected function createFeatureTableQuery($tableName, $columns)
    {
        $columnsSql = implode(", ", array_map(function($column) {
            return "`$column` VARCHAR(255)";
        }, $columns));

        return "CREATE TABLE `$tableName` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            $columnsSql,
            `created_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_at` TIMESTAMP NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    }

    protected function createBrandTableQuery($tableName)
    {
        return "CREATE TABLE `$tableName` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `brand_name` VARCHAR(255),
            `created_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_at` TIMESTAMP NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    }

    protected function createVersionTableQuery($tableName)
    {
        return "CREATE TABLE `$tableName` (
            `id` BIGINT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
            `brand_id` BIGINT UNSIGNED,
            `version` VARCHAR(255),
            `created_at` TIMESTAMP NULL DEFAULT NULL,
            `updated_at` TIMESTAMP NULL DEFAULT NULL
        ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;";
    }

    public function getTodaysPaidAds()
    {
        $paidAds = paid_ad::select('paid_ad_type', DB::raw('MAX(expire_date) as latest_expire_date'))
                    ->groupBy('paid_ad_type')
                    ->get();
    
        $adsResponse = [];
    
        foreach ($paidAds as $paidAd) {
            $adToday = paid_ad::where('paid_ad_type', $paidAd->paid_ad_type)
                            ->whereDate('display_date', '<=', Carbon::today())
                            ->whereDate('expire_date', '>=', Carbon::today())
                            ->first();
    
            if (!$adToday) {
                $adToday = paid_ad::where('paid_ad_type', $paidAd->paid_ad_type)
                                ->orderBy('expire_date', 'desc')
                                ->first();
            }
    
            $nextAd = paid_ad::where('paid_ad_type', $paidAd->paid_ad_type)
                            ->whereDate('display_date', $adToday->expire_date ?? Carbon::today())
                            ->orderBy('display_date', 'asc')
                            ->first();
    
            if ($adToday || $nextAd) {
                $adsResponse[$paidAd->paid_ad_type] = [
                    'today_ad' => $adToday,
                    'next_ad' => $nextAd
                ];
            }
        }
    
        return response()->json(['message' => 'Today\'s and next paid ads retrieved successfully', 'data' => $adsResponse, 'status' => 200]);
    }
    
}
