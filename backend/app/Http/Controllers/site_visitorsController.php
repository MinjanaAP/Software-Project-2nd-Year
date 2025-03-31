<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\site_visitors;

class site_visitorsController extends Controller
{
    public function index(){
        $site_visitors = site_visitors::all();
        return response()->json(['message'=>'success', 'data'=> $site_visitors],200);
    }

    public function create(){
        try{
            $site_visitors = new site_visitors();
            // $site_visitors->id();
            $site_visitors->ip_address = '8263t5972305353.4049';
            
            $site_visitors->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $site_visitors], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request){
        try{
            $site_visitors = new site_visitors();
            // $site_visitors->id();
            $site_visitors->ip_address = $request->ip_address;
            
            $site_visitors->save();
            return response()->json(['message' => 'Record created successfully', 'data' => $site_visitors], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request){
        try{
            $site_visitors = site_visitors::findorFail($request->id);
            $site_visitors->ip_address = $request->ip_address;
            
            $site_visitors->update();
            return response()->json(['message' => 'Record updated successfully', 'data' => $site_visitors], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }
    
    public function delete(Request $request){
        try{
            $site_visitors = site_visitors::findorFail($request->id);
            $site_visitors->delete();
            return response()->json(['message' => 'Record deleted successfully'], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record delete failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show(Request $request){
        try{
            $site_visitors = site_visitors::findorFail($request->id);
            return response()->json(['message' => 'Record retrieve successfully', 'data' => $site_visitors], 201);

        }
        catch(\Exception $e){
            return response()->json(['message' => 'Record retrieve failed', 'data' => $e->getMessage()], 409);
        }
    }


}


