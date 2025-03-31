<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\mobile_phone_features;
use App\Models\brand_names;
use App\Models\mobile_versions;
use App\Models\select_features;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; 



class MobilePhoneFeaturesController extends Controller
{
    public function index(){
        try{
                $Mobile_features = mobile_phone_features::all();
                return response()->json(['message' => 'Data retrieved successfully', 'data' => $Mobile_features], 200);
            }
            catch(\Exception $e){
                return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
            
        }

    }

    public function create(){
        try{
            $Mobile_features = new mobile_phone_features();
            $Mobile_features->Brand='Apple';
            $Mobile_features->Series='i-phone 12';
            $Mobile_features->Display_size='6.1 inch';
            $Mobile_features->Display_type='';
            $Mobile_features->Battery_capercity='96%';
            $Mobile_features->RAM='';
            $Mobile_features->Storage='';
            $Mobile_features->Colour='Black';
            $Mobile_features->Year='2022';
            $Mobile_features->Used_time_period='2 year';
            $Mobile_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Mobile_features], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show($id){
        try{
            $Mobile_features = mobile_phone_features::find($id);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $Mobile_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request){
        try{
            $Mobile_features = mobile_phone_features::findorfail($request->id);
            $Mobile_features->Fill($request->only([
                'Brand',
                'Series',
                'Display_size',
                'Display_type',
                'Battery_capercity',
                'RAM',
                'Storage',
                'Colour',
                'Year',
                'Used_time_period'
            ]));


            return response()->json(['message' => 'Record updated successfully', 'data' => $Mobile_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record updation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try{
            $Mobile_features = mobile_phone_features::findorfail($request->id);
            $Mobile_features->delete();
            return response()->json(['message' => 'Record deleted successfully', 'data' => $Mobile_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $request->validate([
                'freeAd_id' => 'required|exists:free_ads,id',
                'Display_size' => 'required|string|max:255',
                'Display_type' => 'required|string|max:255',
                'Battery_capercity' => 'required|string|max:255',
                'RAM' => 'required|string|max:255',
                'Storage' => 'required|string|max:255',
                'Colour' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
                'Used_time_period' => 'required|string|max:255',
            ]);

            $Mobile_features = new mobile_phone_features();
            $Mobile_features->freeAd_id = $request->freeAd_id;
            $Mobile_features->Display_size=$request->Display_size;
            $Mobile_features->Display_type=$request->Display_type;
            $Mobile_features->Battery_capercity=$request->Battery_capercity;
            $Mobile_features->RAM=$request->RAM;
            $Mobile_features->Storage=$request->Storage;
            $Mobile_features->Colour=$request->Colour;
            $Mobile_features->Year=$request->Year;
            $Mobile_features->Used_time_period=$request->Used_time_period;
            $Mobile_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Mobile_features,'status' => 201]);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function getColNames(){
        try{
            // Get the column names of the mobile_phone_features table
             $allColumns = Schema::getColumnListing('mobile_phone_features');
             $selectedColumns = array_slice($allColumns, 2, 8);
            return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
        
    }

    }



     // POST method to create a new brand name
     public function addBrandNames(Request $request)
     {
         $request->validate([
             'brandName' => 'required|unique:brand_names,brandName',
         ]);
 
         $brandName = new brand_names();
         $brandName->brandName = $request->brandName;
         $brandName->save();
 
         return response()->json(['message' => 'Brand name created successfully', 'data' => $brandName], 201);
     }

    

//add new versions
    public function addVersions(Request $request)
    {
        $request->validate([
            'brandName' => 'required',
            'version' => 'required|string',
        ]);
    
        try {
            $mobileVersion = new mobile_versions();
            //find brandName
            $brandName = brand_names::where('brandName', $request->brandName)->first();
            if($brandName){
                $mobileVersion->brand_id = $brandName->id;
                $mobileVersion->version = $request->version;
                $mobileVersion->save();
            
            

            return response()->json(['message' => 'Mobile version created successfully', 'data' => $mobileVersion], 201);
        }else{
            return response()->json(['message'=>'Requested version is not defined','status'=>401]);
        }
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to create mobile version', 'error' => $e->getMessage()], 500);
        }
    }

     //New method to fetch brands and their versions
     public function getBrandsAndVersions()
     {
         try {
             // Fetch all brands with their corresponding versions
             $brands = brand_names::with('versions')->get();
 
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

    // GET method to fetch all features
    public function getFeatures(){
        try {
            $feature = select_features::pluck('feature');
            return response()->json(['message'=>'success', 'data'=>$feature,'status'=>201]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage(),'status'=>409]);
        }
    }
    // POST method to create new feature
    public function addFeatures(Request $request){
        $request->validate([
            'feature' => 'required|unique:select_features,feature',
        ]);
        $feature = new select_features();
        $feature->feature = $request->feature;
        $feature->save();
        return response()->json(['message' => 'Feature created successfully', 'data' => $feature], 201);
    }


    public function getMobileFeatures($id){
        try {
            $features = mobile_phone_features::where('freeAd_id',$id)->first();
            if($features){
                $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
            }
            return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }

   
}
