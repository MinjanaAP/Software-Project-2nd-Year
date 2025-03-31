<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\report;
use Illuminate\Support\Facades\Route;

class reportController extends Controller
{
    public function index(){
        $report = report::all();
        return response()->json(['message' => 'success', 'data' => $report], 200);
    }

    public function create(){
        try{
            $report = new report();
            // $report ->id();
            $report ->title = 'report ad';
            $report ->description = 'I report this ad';
            $report->save();
            // $report ->timestamps();
            return response()->json(['message' => 'Record created successfully', 'data' => $report], 201);

        }catch(\Exception $e){
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request)
    {
        try{
        $report = new report();
        $report->title=$request->title;
        $report->description=$request->description;
        $report->save();
        return response()->json(['message' => 'Record created successfully', 'data' => $report], 201);
    }catch(\Exception $e){
        return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
    }
    }

    public function edit(Request $request)
    {
        try{
        $report = report::findorfail($request->id);
       
        $report->title=$request->title;
        $report->description=$request->description;
        $report->update();
        return response()->json(['message' => 'Updated successfully', 'data' => $report], 201);
    }catch(\Exception $e){
        return response()->json(['message' => 'Updated failed', 'data' => $e->getMessage()], 409);
    }
    }

    public function delete(Request $request)
    {
        try{
        $report = report::findorfail($request->id)->delete();
        return response()->json(['message' => 'Deleted successfully', 'data' => $report], 201);
    }catch(\Exception $e){
        return response()->json(['message' => 'Deleted failed', 'data' => $e->getMessage()], 409);
    }
    }

    // public function getData(Request $request)
    // {
    //     try{
    //     $report = report::all();
    //     return response()->json($report);
    // }catch(\Exception $e){
    //     return response()->json(['message' => 'Not successful', 'data' => $e->getMessage()], 409);
    // }
    // }
}
