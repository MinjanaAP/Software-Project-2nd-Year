<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Image;

class ImageUploadController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $image = $request->file('image');
        $path = $image->store('images', 's3');
        $url = Storage::disk('s3')->url($path);

        //Save the URL in the database
        $imageModel = new Image();
        $imageModel->url = $url;
        $imageModel->save();

        return response()->json(['success' => 'Image uploaded successfully', 'url' => $url], 200);
    }

    public function index()
    {
        $images = Image::all();
        return response()->json($images, 200);
    }
}
