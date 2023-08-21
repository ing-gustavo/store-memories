<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DownloadController extends Controller
{
    //

    function show($uuid)
    {
        $model = Photo::where('uuid',$uuid)->firstOrFail();

        //Si e una imagen descarga la iamgen , de lo contrario baja un zip

        return view('download.show',['model' => $model]);
    }


    function download($uuid)
    {
        $zip_file = 'enviamelo-'.$uuid.'.zip';
        $zip = new \ZipArchive();
        $zip->open($zip_file, \ZipArchive::CREATE | \ZipArchive::OVERWRITE);

        $model = Photo::where('uuid',$uuid)->firstOrFail();

        $archivos = $model->media;

        foreach($archivos as $media)
        {

            $path_de_imagen = Storage::disk("public")->path($media->id.'/'.$media->name);

            $relativePath = 'enviamelo-'.$uuid.'/' . $media->name;

            $zip->addFile($path_de_imagen, $relativePath);

        }

        $zip->close();
        return response()->download($zip_file);
    }
}
