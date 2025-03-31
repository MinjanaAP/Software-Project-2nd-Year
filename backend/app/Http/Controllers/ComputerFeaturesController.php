<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\computer_features;
use App\Models\computer_brand_name;
use App\Models\computer_version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 


class ComputerFeaturesController extends Controller
{
    public function index(){
        $Computer_features = computer_features::all();
        return response()->json(['message' => 'success', 'data' => $Computer_features], 200);

    }

    public function create(){
        try{
            $Computer_features = new computer_features();
            $Computer_features->RAM='8GB';
            $Computer_features->Hard='1TB';
            $Computer_features->SSD='256GB';
            $Computer_features->Graphics='';
            $Computer_features->Windows='Windows 11 (Original)';
            $Computer_features->Vertion='';
            $Computer_features->Processor_Size='';
            $Computer_features->Screen_size='15';
            $Computer_features->Screen_type='Touch Screen';
            $Computer_features->Colour='Black';
            $Computer_features->Year='2022';
            $Computer_features->Used_time_period='2 year';
            $Computer_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Computer_features,'status' => 201]);
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
                'RAM' => 'required|string|max:255',
                'Hard' => 'required|string|max:255',
                'SSD' => 'required|string|max:255',
                'Graphics' => 'required|string|max:255',
                'Windows' => 'required|string|max:255',
                'Processor_size' => 'required|string|max:255',
                'Screen_size' => 'required|string|max:255',
                'Screen_type' => 'required|string|max:255',
                'Colour' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
                'Used_time_period' => 'required|string|max:255',
            ]);

            $Computer_features = new computer_features();
            $Computer_features->freeAd_id = $request->freeAd_id;
            $Computer_features->RAM=$request->RAM;
            $Computer_features->Hard=$request->Hard;
            $Computer_features->SSD=$request->SSD;
            $Computer_features->Graphics=$request->Graphics;
            $Computer_features->Windows=$request->Windows;
            $Computer_features->Processor_size=$request->Processor_size;
            $Computer_features->Screen_size=$request->Screen_size;
            $Computer_features->Screen_type=$request->Screen_type;
            $Computer_features->Colour=$request->Colour;
            $Computer_features->Year=$request->Year;
            $Computer_features->Used_time_period=$request->Used_time_period;
            $Computer_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Computer_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    }
    
    public function edit(Request $request){
        try{
            $Computer_features = computer_features::findorfail($request->id);
            $Computer_features->fill($request->only([
                'RAM',
                'Hard',
                'SSD',
                'Graphics',
                'Windows',
                'Vertion',
                'Processor',
                'Screen_size',
                'Screen_type',
                'Colour',
                'Year',
                'Used_time_period',
            ]));

            $Computer_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Computer_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Computer_features = computer_features::findorfail($request->id);
            $Computer_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:computer_brand_name,brandName',
         ]);
 
         $brandName = new computer_brand_name();
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
             $computerVersion = new computer_version();
             //find brandName
             $brandName = computer_brand_name::where('brandName', $request->brandName)->first();
             if($brandName){
                 $computerVersion->brand_id = $brandName->id;
                 $computerVersion->version = $request->version;
                 $computerVersion->save();
             
             
 
             return response()->json(['message' => 'Computer version created successfully', 'data' => $computerVersion], 201);
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
            $brands = computer_brand_name::with('versions')->get();

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
             $allColumns = Schema::getColumnListing('computer_features');
             $selectedColumns = array_slice($allColumns, 2, 11);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }

    }

    public function getComputerFeatures($id){
        try {
            $features = computer_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }

}
