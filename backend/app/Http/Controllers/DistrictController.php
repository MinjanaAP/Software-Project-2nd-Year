<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\District;
use Illuminate\Support\Facades\Validator;

class DistrictController extends Controller
{
    public function index(){
        try {
            $district = District::pluck('name');
            return response()->json(['message'=>'success', 'data'=>$district,'status'=>201]);
        } catch (\Throwable $th) {
            return response()->json(['message'=>$th->getMessage(),'status'=>409]);
        }
    }

    public function store(Request $request){
        $validator = Validator::make($request->all(),[
            'name'=>'required|unique:districts,name'
        ]);

        if($validator->fails()){
            return response()->json(['message'=>'Requested district is already added.','error'=>$validator->errors()->toJson(),'status'=>409]);
        }
        try{

            $district = new District();
            $district->name = $request->name;
            $district->save();
            return response()->json(['message'=>'Record created successfully','data'=>$district,'status'=>201]);

        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(), 'status'=>409]);
        }
    }

    public function edit(Request $request){
        try{
            $district = District::findorfail($request->id);
            $district->fill($request->only([
                'name'
            ]));
            $district->update();
            return response()->json(['message'=>'Record updated successfully','data'=>$district,'status'=>201]);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>409]);
        }
    }

    public function delete(Request $request){
        try{
            $district = District::findorfail($request->id);
            $district->delete();
            return response()->json(['message'=>'Record delete successfully.','status'=>201]);
        }catch(\Exception $e){
            return response()->json(['message'=>$e->getMessage(),'status'=>409]);
        }
    }
}
