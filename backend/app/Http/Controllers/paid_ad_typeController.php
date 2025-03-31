<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\paid_ad_type;

class paid_ad_typeController extends Controller
{
    public function index(){
        $paid_ad_type= paid_ad_type::all();

        return response()->json(['message'=>'success','data'=>$paid_ad_type],201);

    }

    public function create(){
        try{
            $paid_ad_type = new paid_ad_type();
            $paid_ad_type->name = 'Figure A';
            $paid_ad_type->description = 'qwertyuiopasdfghjkl';
            $paid_ad_type->price = 1000;
            $paid_ad_type->image = 'sdfghj';
            $paid_ad_type->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $paid_ad_type], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $paid_ad_type =new paid_ad_type();
            $paid_ad_type->name = $request->name;
            $paid_ad_type->description = $request->description;
            $paid_ad_type->price = $request->price;
            $paid_ad_type->image = $request->image;

            $paid_ad_type->save();
            return response()->json(['message' => "Record creation successfully",'data'=>$paid_ad_type],201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request){
        try{
        $paid_ad_type = paid_ad_type::findorFail($request->id);
        $paid_ad_type->fill($request->only([
            'name','description','price','image'
        ]));
        

        $paid_ad_type->update();
        return response()->json(['message' => 'Record updated successfully', 'data' => $paid_ad_type], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try{
            $paid_ad_type = paid_ad_type::findorFail($request->id);

            $paid_ad_type->delete();
            return response()->json(['message'=>'Record deleted successfully'],201);
        }
        catch(\Exception $e){
            return response()->json(['message'=>'Record delete failed','data'=>$e->getMessage()],409);
        }
    }

    public function show($id){
        try{
        $paid_ad_type = paid_ad_type::findorFail($id);

        return response()->json(['message'=>'Record retrieve successfully','data'=>$paid_ad_type],201);
        }
        catch(\Exception $e){
        return response()->json(['message'=>'Record retrieval failed','data'=>$e->getMessage()],409);
        }
    }
}


