<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\laptop_features;
use App\Models\laptop_brand_name;
use App\Models\laptop_version;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class LaptopFeaturesController extends Controller
{
    public function index(){
        $Laptop_features = laptop_features::all();
        return response()->json(['message' => 'success', 'data' => $Laptop_features], 200);

    }

    public function create(){
        try{
            $Laptop_features = new laptop_features();
            $Laptop_features->RAM='8GB';
            $Laptop_features->Hard='1TB';
            $Laptop_features->SSD='256GB';
            $Laptop_features->Graphics='';
            $Laptop_features->Windows='Windows 11 (Original)';
            $Laptop_features->Processor_Size='';
            $Laptop_features->Screen_size='15';
            $Laptop_features->Screen_type='Touch Screen';
            $Laptop_features->Colour='Black';
            $Laptop_features->Year='2022';
            $Laptop_features->Used_time_period='2 year';
            $Laptop_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Laptop_features], 201);
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

            $Laptop_features = new laptop_features();
            $Laptop_features->freeAd_id = $request->freeAd_id;
            $Laptop_features->RAM=$request->RAM;
            $Laptop_features->Hard=$request->Hard;
            $Laptop_features->SSD=$request->SSD;
            $Laptop_features->Graphics=$request->Graphics;
            $Laptop_features->Windows=$request->Windows;
            $Laptop_features->Processor_size=$request->Processor_size;
            $Laptop_features->Screen_size=$request->Screen_size;
            $Laptop_features->Screen_type=$request->Screen_type;
            $Laptop_features->Colour=$request->Colour;
            $Laptop_features->Year=$request->Year;
            $Laptop_features->Used_time_period=$request->Used_time_period;
            $Laptop_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Laptop_features,'status' => 201]);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    }
    
    public function edit(Request $request){
        try{
            $Laptop_features = laptop_features::findorfail($request->id);
            $Laptop_features->fill($request->only([
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

            $Laptop_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Laptop_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Laptop_features = laptop_features::findorfail($request->id);
            $Laptop_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:laptop_brand_name,brandName',
         ]);
 
         $brandName = new laptop_brand_name();
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
             $laptopVersion = new laptop_version();
             //find brandName
             $brandName = laptop_brand_name::where('brandName', $request->brandName)->first();
             if($brandName){
                 $laptopVersion->brand_id = $brandName->id;
                 $laptopVersion->version = $request->version;
                 $laptopVersion->save();
             
             
 
             return response()->json(['message' => 'laptop version created successfully', 'data' => $laptopVersion], 201);
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
            $brands = laptop_brand_name::with('versions')->get();

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
             $allColumns = Schema::getColumnListing('laptop_features');
             $selectedColumns = array_slice($allColumns, 2, 11);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }

    }


    public function getLaptopFeatures($id){
        try {
            $features = laptop_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }


}
