<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Image;

class ImageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('imageUpload');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time() . '.' . $request->image->extension();
        //  Store Images in Public Folder
        $request->image->move(public_path('images'), $imageName);

        //   Store Images in Storage Folder
        // $image->storeAs('images', $imageName);
        // storage/app/images/file.png

        // Store Images in S3
        // $image->storeAs('images', $imageName, 's3');

        Image::create(['name' => $imageName]);

        return response()->json('Image uploaded successfully');
    }
}
