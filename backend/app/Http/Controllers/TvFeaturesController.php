<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\tv_features;
use App\Models\tv_brand_name;
use App\Models\tv_version;
use Illuminate\Http\Request;


class TvFeaturesController extends Controller
{
    public function index(){

        $Tv_features =  tv_features::all();
        return response()->json(['message' => 'success', 'data' => $Tv_features], 200);

    }

    public function create(){
        try{

            $Tv_features = new tv_features();
            $Tv_features->Brand ='Samsung';
            $Tv_features->Screen_size ='';
            $Tv_features->Screen_type = 'Touch Screen';
            $Tv_features->Year = '2023';
            $Tv_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Tv_features,'status' => 201]);
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
                'Screen_size' => 'required|string|max:255',
                'Screen_type' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
            ]);


            $Tv_features = new tv_features();

            $Tv_features->freeAd_id = $request->freeAd_id;
            $Tv_features->Screen_size =$request->Screen_size;
            $Tv_features->Screen_type =$request->Screen_type;
            $Tv_features->Year =$request->Year;
            $Tv_features->save();
           
            return response()->json(['message' => 'Record created successfully', 'data' => $Tv_features,'status' => 201]);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    } 

    public function edit(Request $request){
        try{
            $Tv_features = tv_features::findorfail($request->id);
            $Tv_features->fill($request->only([
                'Brand',
                'Screen_size',
                'Screen_type',
                'Year',
                
            ]));

            $Tv_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Tv_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Tv_features =tv_features::findorfail($request->id);
            $Tv_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

      // POST method to create a new brand name
      public function addBrandNames(Request $request)
      {
          $request->validate([
              'brandName' => 'required|unique:tv_brand_name,brandName',
          ]);
  
          $brandName = new tv_brand_name();
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
              $tvVersion = new tv_version();
              //find brandName
              $brandName = tv_brand_name::where('brandName', $request->brandName)->first();
              if($brandName){
                  $tvVersion->brand_id = $brandName->id;
                  $tvVersion->version = $request->version;
                  $tvVersion->save();
              
              
  
              return response()->json(['message' => 'TV version created successfully', 'data' => $tvVersion], 201);
          }else{
              return response()->json(['message'=>'Requested version is not defined','status'=>401]);
          }
          } catch (\Exception $e) {
              return response()->json(['message' => 'Failed to create tv version', 'error' => $e->getMessage()], 500);
          }
      }
 
     // New method to fetch brands and their versions
     public function getBrandsAndVersions()
     {
         try {
             // Fetch all brands with their corresponding versions
             $brands = tv_brand_name::with('versions')->get();
 
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
             $allColumns = Schema::getColumnListing('tv_features');
             $selectedColumns = array_slice($allColumns, 2, 3);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }
    
    }


    public function getTVFeatures($id){
        try {
            $features = tv_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }
}
