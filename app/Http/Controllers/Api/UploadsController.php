<?php

namespace App\Http\Controllers\Api;

use App\Models\Media;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class UploadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        $request->validate([
            'image'     => 'required|file|image|mimes:jpg,jpeg,png',
        ]);

        //Creating media model
        $media = Media::create([]);

        //Storing file to public
        $path = Storage::disk("public")->put($media->id, $request->file('image'));

        //Cheking that is saved
        if(!$path)
        {
            //Delete media item
            $media->delete();
            //return response()->json(['error','The file could not be saved'],500);
        }


        $uploadedFile       =   $request->file("image");

        //If uploaded succesful, save file information

        $media->name        =   $uploadedFile->hashName();
        $media->file_name   =   $uploadedFile->getClientOriginalName();
        $media->mime_type   =   $uploadedFile->getClientMimeType();
        $media->extension   =   $uploadedFile->extension();
        $media->size        =   $uploadedFile->getSize();
        $media->disk        =   "public";

        //Creating thumb
        $image = Image::make($uploadedFile);

        //Prevent possible upsizing
        $image->resize(null, 350, function ($constraint) {
            $constraint->aspectRatio();
            $constraint->upsize();
        });

        $media->preview_generated  = Storage::disk("public")->put($media->id.'/preview/'.$uploadedFile->hashName(), $image->stream());
        $media->save();

        $media->thumb = Storage::disk($media->disk)->url($media->id.'/preview/'.$media->name);
        $media->save();

        return response()->json($media->id);



    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
       Storage::disk('public')->deleteDirectory($id);
       Media::destroy($id);
    }
}
