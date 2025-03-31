<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\District;
use Illuminate\Http\Request;
use App\Models\Town;
use Illuminate\Support\Facades\Validator;

class TownController extends Controller
{
    public function index(){
        try {
            $town = Town::all('name'); 
            return response()->json(['message' => 'success', 'data' => $town], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function getSpecificTowns(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            'district' => 'required|exists:districts,name'
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => 'Invalid district specified', 'status' => 400]);
        }
    
        try {

            $district = District::where('name', $request->district)->first();
            if (!$district) {
                return response()->json(['message' => 'District not found', 'status' => 404]);
            }

            $towns = Town::where('district_id', $district->id)->pluck('name');
    
            return response()->json(['message' => 'success', 'data' => $towns], 200);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Failed to fetch towns', 'error' => $e->getMessage()], 500);
        }
    }

    public function store(Request $request){
        
        $validator = Validator::make($request->all(),[
            'town'=>'required|unique:towns,name',
            'district'=>'required'
        ]);
        if($validator->fails()){
            return response()->json(['message'=>'Requested town is already added.','error'=>$validator->errors()->toJson(),'status'=>409]);
        }else{
            try{
                $town = new Town();
        
                // Find district
                $district = District::where('name', $request->district)->first();
        
                if($district){
                    $town->name = $request->town;
                    $town->district_id = $district->id;
                    $town->save();
                    return response()->json(['message' => 'Record created successfully', 'data' => $town,'status'=>200]);
                }else{
                    return response()->json(['message'=>'Requested district is not defined','status'=>401]);
                }
        
            }catch(\Exception $e){
                return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage(),'status'=>409]);
            }
        }
        
       
    }
    

    public function show($id){
        try{
            $town = Town::find($id);
            return response()->json(['message' => 'success', 'data' => $town], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function update(Request $request){
        try{
            $town = Town::find($request->id);
            $town->name = $request->name;
            $town->district_id = $request->district_id;
            $town->update();
            return response()->json(['message'=>'Record updated successfully','status'=>201]);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try {
            $town = Town::find($request->id);
            $town->delete();
            return response()->json(['message'=>'Record deleted successfully.','status'=>201]);
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>409]);
        }

    }
}
