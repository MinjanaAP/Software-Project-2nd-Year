<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user_role;

class user_roleController extends Controller
{
    public function index(){
        try {
            $user_role = user_role::all(); //get all users
            return response()->json(['message' => 'success', 'data' => $user_role], 201);

        } catch (\Exception $e) {
            return response()->json(['message' => 'failed', 'data' => $e->getMessage()], 409);
        }
    }


    public function create(){
        try{
            $user_role = new user_role();
            $user_role->name = 'user role name';
         

            $user_role->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $user_role], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $user_role = new user_role();
            $user_role->name = $request->name;
            
            // $user->user_role_id  = 1234; //foreign key

            $user_role->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $user_role], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request){
        try{
            $user_role = user_role::findorfail($request->id);
            $user_role->fill($request->only([
                'name',]));
            
            $user_role->update();
            return response()->json(['message' => 'Record updated successfully', 'data' => $user_role], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record updated failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try{
            $user_role = user_role::findorfail($request->id);
            
            $user_role->delete();
            return response()->json(['message' => 'Record deleted successfully', 'data' => $user_role], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record deleted failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show($id){
        try{
            $user_role = user_role::findorfail($id);

            
            return response()->json(['message' => 'Record retrive successfully', 'data' => $user_role], 201);
        }catch(\Exception $e){
            return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 409);
        }
    }


}
