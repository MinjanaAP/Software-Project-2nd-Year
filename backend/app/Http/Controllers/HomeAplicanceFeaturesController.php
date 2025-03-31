<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Schema;
use App\Models\home_aplicance_features;
use App\Models\home_applicance_brand_name;
use App\Models\home_applicance_version;
use Illuminate\Http\Request;


class HomeAplicanceFeaturesController extends Controller
{
    public function index(){

        $Home_Aplicance_features = home_aplicance_features::all();
        return response()->json(['message' => 'success', 'data' => $Home_Aplicance_features], 200);

    }

    public function create(){
        try{
            $Home_Aplicance_features = new home_aplicance_features();
            $Home_Aplicance_features->Brand ='Samsung';
            $Home_Aplicance_features->Size ='';
            $Home_Aplicance_features->colour = 'White';
            $Home_Aplicance_features->Year = '2023';
            $Home_Aplicance_features->Used_time_period = '6 months';
            $Home_Aplicance_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Home_Aplicance_features], 201);
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
                'Colour' => 'required|string|max:255',
                'Year' => 'required|string|max:255',
                'Used_time_period' => 'required|string|max:255',
            ]);
            $Home_Aplicance_features= new home_aplicance_features();
            $Home_Aplicance_features->freeAd_id = $request->freeAd_id;
            $Home_Aplicance_features->Size=$request->Size;
            $Home_Aplicance_features->Colour=$request->Colour;
            $Home_Aplicance_features->Year=$request->Year;
            $Home_Aplicance_features->Used_time_period=$request->Used_time_period;
            $Home_Aplicance_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Home_Aplicance_features,'status' => 201]);
        }

        catch(\Exception $e){

            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    }

    public function edit(Request $request){
        try{
            $Home_Aplicance_features = home_aplicance_features::findorfail($request->id);
            $Home_Aplicance_features->fill($request->only([
                'Brand',
                'Size',
                'Colour',
                'Year',
                'Used_time_period',
            ]));

            $Home_Aplicance_features->update();

            return response()->json(['message' => 'Record created successfully', 'data' => $Home_Aplicance_features], 201);

        }

        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    
    }

    public function delete(Request $request){
        try{

            $Home_Aplicance_features = home_aplicance_features::findorfail($request->id);
            $Home_Aplicance_features->delete();

            return response()->json(['message' => 'Record deleted successfully'], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }

    }

    // POST method to create a new brand name
    public function addBrandNames(Request $request)
    {
        $request->validate([
            'brandName' => 'required|unique:home_applicance_brand_name,brandName',
        ]);

        $brandName = new home_applicance_brand_name();
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
            $homeApplicanceVersion = new home_applicance_version();
            //find brandName
            $brandName = home_applicance_brand_name::where('brandName', $request->brandName)->first();
            if($brandName){
                $homeApplicanceVersion->brand_id = $brandName->id;
                $homeApplicanceVersion->version = $request->version;
                $homeApplicanceVersion->save();
            
            

            return response()->json(['message' => 'version created successfully', 'data' => $homeApplicanceVersion], 201);
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
           $brands = home_applicance_brand_name::with('versions')->get();

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
         $allColumns = Schema::getColumnListing('home_aplicance_features');
         $selectedColumns = array_slice($allColumns, 2, 4);
        return response()->json(['message' => 'Data retrieved successfully', 'data' => $selectedColumns], 200);
    }
    catch(\Exception $e){
        return response()->json(['message' => 'Data retrieval failed', 'data' => $e->getMessage()], 409);
    
}

}


public function getHomeAplicanceFeatures($id){
    try {
        $features = home_aplicance_features::where('freeAd_id',$id)->first();
        if($features){
            $features -> makeHidden (['id','freeAd_id','created_at','updated_at']);
        }
        return response()->json(['message' => 'Record retrieved successfully', 'data' => $features], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
    }
}


}

