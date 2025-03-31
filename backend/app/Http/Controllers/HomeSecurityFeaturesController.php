<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\home_security_features;
use App\Models\home_security_brand_name;
use App\Models\home_security_version;
use Illuminate\Http\Request;


class HomeSecurityFeaturesController extends Controller
{
    public function index(){
        $Home_Security_features =  home_security_features::all();
        return response()->json(['message' => 'success', 'data' => $Home_Security_features], 200);

    }

    public function create(){
        try{
            $Home_Security_features = new home_security_features();
            $Home_Security_features->Brand ='Samsung';
            $Home_Security_features->Size ='';
            $Home_Security_features->Wireless_or_not='Not';
            $Home_Security_features->Battery_capercity='';
            $Home_Security_features->colour = 'White';
            $Home_Security_features->Year = '2023';
            $Home_Security_features->Used_time_period = '6 months';
            $Home_Security_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Home_Security_features], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

        public function store(Request $request){
            try{
                $request->validate([
                    'freeAd_id' => 'required|exists:free_ads,id',
                    'Size' => 'required|string|max:255',
                    'Wireless_or_not' => 'required|string|max:255',
                    'Battery_capercity' => 'required|string|max:255',
                    'Colour' => 'required|string|max:255',
                    'Year' => 'required|string|max:255',
                    'Used_time_period' => 'required|string|max:255',
                ]);
                $Home_Security_features = new home_security_features();
                $Home_Security_features->freeAd_id = $request->freeAd_id;
                $Home_Security_features->Size =$request->Size;
                $Home_Security_features->Wireless_or_not=$request->Wireless_or_not;
                $Home_Security_features->Battery_capercity=$request->Battery_capercity;
                $Home_Security_features->Colour =$request->Colour;
                $Home_Security_features->Year =$request->Year;
                $Home_Security_features->Used_time_period =$request->Used_time_period;
                $Home_Security_features->save();
    
                return response()->json(['message' => 'Record created successfully', 'data' => $Home_Security_features,'status' => 201]);
            }
            catch(\Exception $e){
                return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
}

    }

    public function edit(Request $request){
        try{
            $Home_Security_features = home_security_features::findorfail($request->id);
            $Home_Security_features->fill($request->only([
                'Brand',
                'Size',
                'Wireless_or_not',
                'Battery_capercity',
                'Colour',
                'Year',
                'Used_time_period',
            ]));

            $Home_Security_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Home_Security_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Home_Security_features =home_security_features::findorfail($request->id);
            $Home_Security_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:home_security_brand_name,brandName',
         ]);
 
         $brandName = new home_security_brand_name();
         $brandName->brandName = $request->brandName;
         $brandName->save();
 
         return response()->json(['message' => 'Brand name created successfully', 'data' => $brandName], 201);
     }
 
     //post method to add new versions
     public function addVersions(Request $request)
     {
         $request->validate([
             'brandName' => 'required',
             'version' => 'required|string',
         ]);
     
         try {
             $homeSecurityVersion = new home_security_version();
             //find brandName
             $brandName = home_security_brand_name::where('brandName', $request->brandName)->first();
             if($brandName){
                 $homeSecurityVersion->brand_id = $brandName->id;
                 $homeSecurityVersion->version = $request->version;
                 $homeSecurityVersion->save();
             
             
 
             return response()->json(['message' => 'version created successfully', 'data' => $homeSecurityVersion], 201);
         }else{
             return response()->json(['message'=>'Requested version is not defined','status'=>401]);
         }
         } catch (\Exception $e) {
             return response()->json(['message' => 'Failed to create mobile version', 'error' => $e->getMessage()], 500);
         }
     }
 
    // New method to fetch brands and their versions
    public function getBrandsAndVersions()
    {
        try {
            // Fetch all brands with their corresponding versions
            $brands = home_security_brand_name::with('versions')->get();
 
            // Format the data
            $data = $brands->map(function($brand) {
                return [
                    'brandName' => $brand->brandName,
                    'versions' => $brand->versions->pluck('version')
                ];
            });
 
            return response()->json(['message' => 'success', 'data' => $data, 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 409]);
        }
    }
    
    public function getColNames(){
        try{
            // Get the column names of the mobile_phone_features table
             $allColumns = Schema::getColumnListing('home_security_features');
             $selectedColumns = array_slice($allColumns, 2, 6);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }
    
    }

    public function getHomeSecurityFeatures($id){
        try {
            $features = home_security_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }

}
