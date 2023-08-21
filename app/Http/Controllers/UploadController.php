<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Gallery;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
class UploadController extends Controller
{

    function show(Gallery $gallery)
    {
        return $gallery->getThumbnails();
    }

    function store(Request $request)
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
            return response()->json(['error','The file could not be saved'],500);
        }


        $uploadedFile       =   $request->file("image");
        info($uploadedFile->hashName());
        info($uploadedFile->getClientOriginalName());
        info($uploadedFile->getClientMimeType());


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

        return response()->json($media->getImage());

    }


}
