<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\categories;


class CategoriesController extends Controller
{
    public function index(){
        $Categories = categories::all();
        return response()->json(['message'=>'success', 'data'=> $Categories],200);
    }

    public function create(){
        try{
            $Categories = new categories();
            $Categories->Name='Electronic Category';
            $Categories->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Categories], 201);
        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $Categories = new categories();
            $Categories->Name = $request->Name;
            
            $Categories->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $Categories], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request){
        try{
            $Categories = categories::findorFail($request->id);
            $Categories->Name = $request->Name;
            
            $Categories->update();
            return response()->json(['message' => 'Record updated successfully', 'data' => $Categories], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete(Request $request){
        try{
            $Categories = categories::findorFail($request->id);
            $Categories->delete();
            return response()->json(['message' => 'Record deleted successfully'], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record delete failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show(Request $request){
        try{
            $Categories =  categories::findorFail($request->id);
            return response()->json(['message' => 'Record retrieve successfully', 'data' => $Categories], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record retrieve failed', 'data' => $e->getMessage()], 409);
        }
    }
}
