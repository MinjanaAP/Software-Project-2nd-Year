<?php

namespace App\Http\Controllers;
use App\Models\healths_item_features;
use Illuminate\Http\Request;

class HealthsItemFeaturesController extends Controller
{
    public function index(){
        try{
            $Health_features = healths_item_features::all();
            return response()->json(['message' => 'Records found', 'data' => $Health_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Records not found', 'data' => $e->getMessage()], 404);
        }

    }

    public function create(){
        try{
            $Health_features = new healths_item_features();
            $Health_features->Brand ='Apple';
            $Health_features->Size ='';
            $Health_features->colour = 'White';
            $Health_features->Year = '2023';
            $Health_features->Used_time_period = '6 months';
            $Health_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Health_features], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $Health_features= new healths_item_features();
            $Health_features->Brand=$request->Brand;
            $Health_features->Size=$request->Size;
            $Health_features->Colour=$request->Colour;
            $Health_features->Year=$request->Year;
            $Health_features->Used_time_period=$request->Used_time_period;
            $Health_features->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Health_features,'status' => 201]);
        }

        catch(\Exception $e){

            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }

    }

    public function edit(Request $request){
        try{
            $Health_features = healths_item_features::findorfail($request->id);
            $Health_features->fill($request->only([
                'Brand',
                'Size',
                'Colour',
                'Year',
                'Used_time_period'
            ]));
            $Health_features->save();

            return response()->json(['message' => 'Record updated successfully', 'data' => $Health_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record updation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete($id){
        try{
            $Health_features = healths_item_features::findorfail($id);
            $Health_features->delete();
            return response()->json(['message' => 'Record deleted successfully', 'data' => $Health_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record deletion failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show($id){
        try{
            $Health_features = healths_item_features::findorfail($id);
            return response()->json(['message' => 'Record found', 'data' => $Health_features], 200);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record not found', 'data' => $e->getMessage()], 404);
        }
    }

}
