<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\camera_features;
use App\Models\camera_brand_name;
use App\Models\camera_version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CameraFeaturesController extends Controller
{
    public function index(){
        $Camera_features = camera_features::all();
        return response()->json(['message' => 'success', 'data' => $Camera_features], 200);

    }

    public function create(){
        try{
            $Camera_features = new camera_features();
            $Camera_features->Resolution='24MP';
            $Camera_features->Lens_type='Wide-Angle';
            $Camera_features->Zoom='10x';
            $Camera_features->Screen_type='LCD';
            $Camera_features->Year='2022';
            $Camera_features->Used_time_period='2 year';
            $Camera_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Camera_features], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request)
    {
        try{

            $request->validate([
                'freeAd_id' => 'required|exists:free_ads,id',
                'Resolution' => 'required|string|max:255',
                'Lens_type' => 'required|string|max:255',
                'Zoom' => 'required|string|max:255',
                'Screen_type' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
                'Used_time_period' => 'required|string|max:255',
            ]);

            $Camera_features = new camera_features();
            $Camera_features->freeAd_id = $request->freeAd_id;
            $Camera_features->Resolution=$request->Resolution;
            $Camera_features->Lens_type=$request->Lens_type;
            $Camera_features->Zoom=$request->Zoom;
            $Camera_features->Screen_type=$request->Screen_type;
            $Camera_features->Year=$request->Year;
            $Camera_features->Used_time_period=$request->Used_time_period;
            $Camera_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Camera_features,'status' => 201]);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    }
    
    public function edit(Request $request){
        try{
            $Camera_features = camera_features::findorfail($request->id);
            $Camera_features->fill($request->only([
                'Resolution',
                'Lens_type',
                'Zoom',
                'Screen_type',
                'Year',
                'Used_time_period',
            ]));

            $Camera_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Camera_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Camera_features = camera_features::findorfail($request->id);
            $Camera_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:camera_brand_name,brandName',
         ]);
 
         $brandName = new camera_brand_name();
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
             $cameraVersion = new camera_version();
             //find brandName
             $brandName = camera_brand_name::where('brandName', $request->brandName)->first();
             if($brandName){
                 $cameraVersion->brand_id = $brandName->id;
                 $cameraVersion->version = $request->version;
                 $cameraVersion->save();
             
             
 
             return response()->json(['message' => 'camera version created successfully', 'data' => $cameraVersion], 201);
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
            $brands = camera_brand_name::with('versions')->get();

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
             $allColumns = Schema::getColumnListing('camera_features');
             $selectedColumns = array_slice($allColumns, 2, 6);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }

    }

    public function getCameraFeatures($id){
        try {
            $features = camera_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }
}
