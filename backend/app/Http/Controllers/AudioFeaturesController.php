<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\audio_features;
use App\Models\sound_brand_name;
use App\Models\sound_version;
use Illuminate\Http\Request;

class AudioFeaturesController extends Controller
{
    public function index(){
        try{
            $Audio_features = audio_features::all();
            return response()->json(['message' => 'Records found', 'data' => $Audio_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Records not found', 'data' => $e->getMessage()], 404);
        }
    }

    public function create(){
        try{
            $Audio_features = new audio_features();
            $Audio_features->Brand ='Apple';
            $Audio_features->Wireless_or_not ='Wireless';
            $Audio_features->Battery_capercity = '80%';
            $Audio_features->Colour = 'White';
            $Audio_features->Year = '2023';
            $Audio_features->Used_time_period = '1 year';
            $Audio_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Audio_features], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }


    public function show($id){
        try{
            $Audio_features = audio_features::findorfail($id);
            return response()->json(['message' => 'Record found', 'data' => $Audio_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record not found', 'data' => $e->getMessage()], 404);
        }
    }

    public function edit(Request $request){
        try{
            $Audio_features = audio_features::findorfail($request->id);
            $Audio_features->Fill($request->only([
                'Brand',
                'Wireless_or_not',
                'Battery_capercity',
                'Colour',
                'Year',
                'Used_time_period'
            ]));
            $Audio_features->save();
            return response()->json(['message' => 'Record updated successfully', 'data' => $Audio_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record updation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete($id){
        try{
            $Audio_features = audio_features::findorfail($id);
            $Audio_features->delete();
            return response()->json(['message' => 'Record deleted successfully', 'data' => $Audio_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $request->validate([
                'freeAd_id' => 'required|exists:free_ads,id',
                'Wireless_or_not' => 'required|string|max:255',
                'Battery_capercity' => 'required|string|max:255',
                'Colour' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
                'Used_time_period' => 'required|string|max:255',
            ]);

            $Audio_features = new audio_features();
            $Audio_features->freeAd_id = $request->freeAd_id;
            $Audio_features->Wireless_or_not=$request->Wireless_or_not;
            $Audio_features->Battery_capercity=$request->Battery_capercity;
            $Audio_features->Colour=$request->Colour;
            $Audio_features->Year=$request->Year;
            $Audio_features->Used_time_period=$request->Used_time_period;
            $Audio_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Audio_features,'status' => 201]);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:sound_brand_name,brandName',
         ]);
 
         $brandName = new sound_brand_name();
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
             $soundVersion = new sound_version();
             //find brandName
             $brandName = sound_brand_name::where('brandName', $request->brandName)->first();
             if($brandName){
                 $soundVersion->brand_id = $brandName->id;
                 $soundVersion->version = $request->version;
                 $soundVersion->save();
             
             
 
             return response()->json(['message' => 'Sound version created successfully', 'data' => $soundVersion], 201);
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
            $brands = sound_brand_name::with('versions')->get();

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
             $allColumns = Schema::getColumnListing('audio_features');
             $selectedColumns = array_slice($allColumns, 2, 5);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }
    
    }

    public function getAudioFeatures($id){
        try {
            $features = audio_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }
    
}
