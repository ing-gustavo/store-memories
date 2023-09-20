<?php

namespace App\Http\Controllers\Api;

use Carbon\Carbon;
use App\Models\Media;
use App\Models\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;
use App\Http\Resources\DownloadResource;
use Illuminate\Support\Facades\Notification;
use App\Notifications\NotificarQueFueDescargado;

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

    public function getSingleFile(String $id)
    {
        $media = Media::findOrFail($id);
        $path_de_imagen = Storage::disk("public")->path($media->id.'/'.$media->name);
        return response()->download($path_de_imagen);
    }

    public function getFolder(String $id)
    {
        $download = Photo::findOrFail($id);

        $zip_file = 'enviamelo-'.$download->uuid.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $archivos = $download->media;

        foreach($archivos as $media)
        {

            $path_de_imagen = Storage::disk("public")->path($media->id.'/'.$media->name);

            $relativePath = 'enviamelo-'.$download->uuid.'/' . $media->file_name;

            $zip->addFile($path_de_imagen, $relativePath);

        }

        $zip->close();
        return response()->download($zip_file);

    }

    public function markAsDownloaded(String $id)
    {
        $download = Photo::findOrFail($id);

        if($download->was_downloaded)
        {
            return new DownloadResource($download);
        }

        $download->was_downloaded = true;
        $download->downloaded_at = Carbon::now();
        $download->save();

        Notification::route('mail', $download->from)->notify(new NotificarQueFueDescargado($download));

        return new DownloadResource($download);
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
