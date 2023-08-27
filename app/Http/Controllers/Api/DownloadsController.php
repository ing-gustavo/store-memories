<?php

namespace App\Http\Controllers\Api;

use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DownloadResource;

class DownloadsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $uuid)
    {
        $download = Photo::where('uuid',$uuid)->firstOrFail();
        return new DownloadResource($download);
    }

    public function getFolder(String $id)
    {
        $download = Photo::findOrFail($id);
    
        $zip_file = 'enviamelo-'.$download->uuid.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $model = Photo::where('uuid',$download->uuid)->firstOrFail();

        $archivos = $model->media;

        foreach($archivos as $media)
        {

            $path_de_imagen = Storage::disk("public")->path($media->id.'/'.$media->name);

            $relativePath = 'enviamelo-'.$download->uuid.'/' . $media->name;

            $zip->addFile($path_de_imagen, $relativePath);

        }

        $zip->close();
        return response()->download($zip_file);

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
        //
    }
}
