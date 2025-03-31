<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\sub_categories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Aws\S3\S3Client;
use Illuminate\Database\Schema\Blueprint;

class SubCategoriesController extends Controller
{
    public function index()
    {
        $sub_categories = sub_categories::all();
        return response()->json(['message' => 'success', 'data' => $sub_categories], 200);
    }

    public function create()
    {
        try {
            $Sub_categories = new sub_categories();
            $Sub_categories->Name = 'Mobile Phone';
            $Sub_categories->save();

            return response()->json(['message' => 'Record created successfully', 'data' => $Sub_categories], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcategory' => 'required|string|unique:sub_categories,Name',
            'featureTableName' => 'required|string',
            'columnsOfFeatureTable' => 'required|json',
            'subcategoryImage' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'subcategoryIcon' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        DB::beginTransaction();
        try {
            $subCategory = new SubCategory();
            $subCategory->Name = $request->subcategory;
            $subCategory->feature_table = $request->featureTableName;

            if ($request->hasFile('subcategoryImage')) {
                $image = $request->file('subcategoryImage');
                $path = Storage::disk('s3')->put('subCategory_images', $image);
                $url = Storage::disk('s3')->url($path);
                $subCategory->image_url = $url;
            }

            if ($request->hasFile('subcategoryIcon')) {
                $icon = $request->file('subcategoryIcon');
                $path = Storage::disk('s3')->put('subCategory_icons', $icon);
                $url = Storage::disk('s3')->url($path);
                $subCategory->icon_url = $url;
            }

            $subCategory->save();

            // Create the new table
            $tableName = $request->featureTableName;
            $columns = json_decode($request->columnsOfFeatureTable, true);

            Schema::create($tableName, function (Blueprint $table) use ($columns) {
                $table->id();
                foreach ($columns as $column => $type) {
                    $table->addColumn($type, $column);
                }
                $table->timestamps();
            });

            DB::commit();
            return response()->json(['message' => 'Record created successfully', 'data' => $subCategory, 'status' => 200]);
        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function edit(Request $request)
    {
        try {
            $sub_categories = sub_categories::findOrFail($request->id);
            $sub_categories->Name = $request->Name;

            $sub_categories->update();
            return response()->json(['message' => 'Record updated successfully', 'data' => $sub_categories], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record update failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function show(Request $request)
    {
        try {
            $sub_categories = sub_categories::findOrFail($request->id);
            return response()->json(['message' => 'Record retrieve successfully', 'data' => $sub_categories], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Record retrieve failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function delete($subcategory)
    {
        try {
            $subcategory = sub_categories::where('Name', $subcategory)->firstOrFail();

            // AWS S3 client configuration
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            // Extract S3 key from URL
            $imageKey = parse_url($subcategory->image_url, PHP_URL_PATH);

            // Delete image from S3
            $s3Client->deleteObject([
                'Bucket' => env('AWS_BUCKET'),
                'Key' => ltrim($imageKey, '/'), // Remove leading slash if any
            ]);

            // Delete the subcategory record from the database
            $subcategory->delete();

            return response()->json(['message' => 'Subcategory deleted successfully', 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Subcategory deletion failed', 'data' => $e->getMessage()], 409);
        }
    }

    public function editSubcategory(Request $request, $subcategory)
    {
        $validator = Validator::make($request->all(), [
            'Name' => 'required|string|unique:sub_categories,Name,' . $subcategory,
            'image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            // Find the subcategory by name
            $subcategory = sub_categories::where('Name', $subcategory)->firstOrFail();

            // AWS S3 client configuration
            $s3Client = new S3Client([
                'version' => 'latest',
                'region' => env('AWS_DEFAULT_REGION'),
                'credentials' => [
                    'key' => env('AWS_ACCESS_KEY_ID'),
                    'secret' => env('AWS_SECRET_ACCESS_KEY'),
                ],
            ]);

            // Delete the existing image from S3 if it exists
            if ($subcategory->image_url && $request->hasFile('image')) {
                $imageKey = parse_url($subcategory->image_url, PHP_URL_PATH);
                $s3Client->deleteObject([
                    'Bucket' => env('AWS_BUCKET'),
                    'Key' => ltrim($imageKey, '/'), // Remove leading slash if any
                ]);
            }

            // Upload the new image to S3
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $path = Storage::disk('s3')->put('subCategory_images', $image);
                $url = Storage::disk('s3')->url($path);
                $subcategory->image_url = $url;
            }

            // Update the subcategory details
            $subcategory->Name = $request->Name;
            $subcategory->save();

        return response()->json(['message' => 'Subcategory updated successfully', 'data' => $subcategory, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Subcategory edit failed', 'data' => $e->getMessage()], 409);
        }
    }
    public function getExistingBrands(Request $request)
    {
        try {
            $subcategory = sub_categories::where('Name', $request->Name)->first();

            if (!$subcategory) {
                return response()->json(['message' => 'Subcategory not found', 'status' => 404]);
            }

            $brandTableName = $subcategory->brands_table;

            if (!$brandTableName) {
                return response()->json(['message' => 'Brand table not defined for this subcategory', 'status' => 400]);
            }

            $brands = DB::table($brandTableName)->get();

            $data = $brands->map(function($brand) {
                return [
                    'brandName' => $brand->brandName,
                ];
            });

            return response()->json(['message' => 'success', 'data' => $brands, 'status' => 200]);
        } catch (\Throwable $th) {
            return response()->json(['message' => $th->getMessage(), 'status' => 409]);
        }
    }

    public function newBrandAdding(Request $request)
    {
        $request->validate([
            'subcategory' => 'required',
            'brandName' => 'required|string|max:255',
        ]);

        $subCategory = $request->input('subcategory');
        $brandName = $request->input('brandName');

        // Get the relevant brand table name from the sub_categories table
        $brandTable = DB::table('sub_categories')
            ->where('Name', $subCategory)
            ->value('brands_table');

        if ($brandTable) {
            // Check if the table exists
            if (Schema::hasTable($brandTable)) {
                // Insert the new brand into the relevant brand table
                DB::table($brandTable)->insert(['brandName' => $brandName]);

                return response()->json(['status' => 200, 'message' => 'Brand added successfully!']);
            } else {
                return response()->json(['status' => 500, 'message' => 'Brand table does not exist.']);
            }
        } else {
            return response()->json(['status' => 404, 'message' => 'Sub-category does not exist.']);
        }
    }

    public function getFeatureTable($subCategory)
    {
        $subCategory = sub_categories::where('Name', $subCategory)->first();
        return response()->json(['feature_table' => $subCategory->feature_table]);
    }

    public function addFeature(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'subcategory'=>'required|exists:sub_categories,Name',
            'feature'=>'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->toJson(),'status'=>400]);
        }
    
        $featureTable = sub_categories::where('Name', $request->input('subcategory'))->first()->feature_table;
        $newFeature = $request->input('feature');

        if (!Schema::hasColumn($featureTable, $newFeature)) {
            Schema::table($featureTable, function (Blueprint $table) use ($newFeature) {
                $table->string($newFeature)->nullable();
            });
    
            return response()->json(['message' => 'Feature added successfully.','status'=>200]);
        } else {
            return response()->json(['message' => 'Feature already exists.','status'=>401]);
        }
    }

    public function getExistingFeature(Request $request){
        try {
            $subcategory = sub_categories::where('Name', $request->subcategory)->first();

            if (!$subcategory) {
                return response()->json(['message' => 'Subcategory not found', 'status' => 404]);
            }

            $featureTableName = $subcategory->feature_table;

            if (!$featureTableName) {
                return response()->json(['message' => 'Brand table not defined for this subcategory', 'status' => 400]);
            }

            $columns = Schema::getColumnListing($featureTableName);

            $filteredColumns = array_filter($columns, function($column) {
                return !in_array($column, ['id', 'freeAd_id', 'created_at', 'updated_at']);
            });

            return response()->json(['message'=>'Features retrieved successfully.','data'=>$filteredColumns,'status'=>200]);

        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>401]);
        }
    }

    public function getExistingVersions(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'subcategory' => 'required|exists:sub_categories,Name',
            'brandName' => 'required|string',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->toJson(), 'status' => 400]);
        }
    
        try {
            $subCategory = sub_categories::where('Name', $request->subcategory)->first();
    
            $brandTable = $subCategory->brands_table;
            if (!$brandTable) {
                return response()->json(['message' => 'Brand table not defined for this subcategory.', 'status' => 400]);
            }
    
            $brandId = DB::table($brandTable)->where('brandName', $request->brandName)->value('id');
            if (!$brandId) {
                return response()->json(['message' => 'Brand not found in the brand table.', 'status' => 400]);
            }
    
            $versionTable = $subCategory->version_table;
            if (!$versionTable) {
                return response()->json(['message' => 'Version table not defined for this subcategory.', 'status' => 400]);
            }
    
            $versions = DB::table($versionTable)->where('brand_id', $brandId)->pluck('version');
    
            return response()->json(['message' => 'Existing Versions retrieved successfully.', 'data' => $versions, 'status' => 200]);
        } catch (\Exception $e) {
            return response()->json(['message' => $e->getMessage(), 'status' => 404]);
        }
    }

    public function addNewVersion(Request $request){
        $validator = Validator::make($request->all(),[
            'subcategory'=>'required|exists:sub_categories,Name',
            'brandName'=>'required|string',
            'version'=>'required|string'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()->toJson(),'status'=>400]);
        }

        try {
            $subCategory = sub_categories::where('Name', $request->input('subcategory'))->first();
            if(!$subCategory){
                return response()->json(['message'=>'Subcategory not found.','status'=>404]);
            }
            $brandTable = $subCategory->brands_table;
            if(!$brandTable){
                return response()->json(['message'=>'Brand table not defined for this subcategory.','status'=>400]);
            }
            $brandId = DB::table($brandTable)->where('brandName', $request->input('brandName'))->value('id');
            $versionTable = $subCategory->version_table;
            if ($versionTable) {
                if (Schema::hasTable($versionTable)) {
                    
                    DB::table($versionTable)->insert(['brand_id'=>$brandId,'version' => $request->version]);
    
                    return response()->json(['status' => 200, 'message' => 'Version added successfully!']);
                } else {
                    return response()->json(['status' => 500, 'message' => 'Version table does not exist.']);
                }
            } else {
                return response()->json(['status' => 404, 'message' => 'Version Table does not exist.']);
            }
        } catch (\Exception $e) {
            return response()->json(['message'=>$e->getMessage(),'status'=>404]);
        }

    }
    

public function addSubCategoryIcon(Request $request){
    $validator = Validator::make($request->all(), [
        'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048'
    ]);

    if ($validator->fails()) {
        return response()->json($validator->errors()->toJson(), 400);
    }

    if ($request->hasFile('image')) {
        $image = $request->file('image');
        $path = Storage::disk('s3')->put('subCategory_icons', $image);
        $url = Storage::disk('s3')->url($path);
    }

    return response()->json(['message' => 'Subcategory icon uploaded successfully', 'data' => $url, 'status' => 200]);
}



public function getFeatureTableName(Request $request)
{
    try{
        $subcategoryRecord = sub_categories::where('Name', $request->input('subCategory'))->first();
        if (!$subcategoryRecord) {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }

        $featureTableName = $subcategoryRecord->feature_table;
        return response()->json(['message' => 'Record retrieved successfully', 'data' => $featureTableName], 200);

    }catch (\Exception $e) {
        return ['message' => 'Record retrieval failed', 'data' => $e->getMessage()];
    }
}

public function getFeatureTableColumns(Request $request)
{
    try {
        $subcategoryRecord = sub_categories::where('Name', $request->input('subCategory'))->first();
        // $subcategoryRecord = DB::table('subcategory')
        //     ->where('subcategory_name', $subcategory)
        //     ->first();

        if (!$subcategoryRecord) {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }

        $featureTableName = $subcategoryRecord->feature_table;

        // get column name from feature tables 
        $columns = Schema::getColumnListing($featureTableName);

        // only get features columns
        $filteredColumns = array_diff($columns, ['id', 'freeAd_id', 'created_at', 'updated_at']);

        // Reindex array to remove numeric keys
        $filteredColumns = array_values($filteredColumns);

        return response()->json(['message' => 'Record retrieved successfully', 'data' => $filteredColumns], 200);
    } catch (\Exception $e) {
        return ['message' => 'Record retrieval failed', 'data' => $e->getMessage()];
    }
}

public function getBrandsAndVersions(Request $request)
{
    try {
        $subcategoryRecord = sub_categories::where('Name', $request->input('subCategory'))->first();

        if (!$subcategoryRecord) {
            return response()->json(['message' => 'Subcategory not found'], 404);
        }

        $brandTableName = $subcategoryRecord->brands_table;
        $versionTableName = $subcategoryRecord->version_table;

        if (!Schema::hasTable($brandTableName) || !Schema::hasTable($versionTableName)) {
            return response()->json(['message' => 'Brand or version table does not exist'], 404);
        }

        // Get all brands
        $brands = DB::table($brandTableName)->get();

        // Format the data
        $data = $brands->map(function ($brand) use ($versionTableName) {
            return [
                'brandName' => $brand->brandName,
                'versions' => DB::table($versionTableName)
                    ->where('brand_id', $brand->id) 
                    ->pluck('version')
            ];
        });

        return response()->json(['message' => 'Record retrieved successfully', 'data' => $data], 200);
    } catch (\Exception $e) {
        return response()->json(['message' => 'Record retrieval failed', 'data' => $e->getMessage()], 500);
    }
}

public function storeSubCategoryFeatures(Request $request)
{
    try {
        
        $request->validate([
            'freeAd_id' => 'required|exists:free_ads,id',
            'subCategory' => 'required|string|exists:sub_categories,name',
        ]);

        
        $subCategory = sub_categories::where('Name', $request->input('subCategory'))->firstOrFail();
        $featureTableName = $subCategory->feature_table;

        
        $columns = DB::getSchemaBuilder()->getColumnListing($featureTableName);

        
        $data = [];
        foreach ($columns as $column) {
            if ($request->has($column)) {
                $data[$column] = $request->input($column);
            }
        }
        $data['freeAd_id'] = $request->input('freeAd_id');

        
        DB::table($featureTableName)->insert($data);

        return response()->json(['message' => 'Record created successfully', 'data' => $data, 'status' => 201]);

    } catch (\Exception $e) {
        return response()->json(['message' => 'Record creation failed', 'data' => $e->getMessage()], 409);
    }
}
}