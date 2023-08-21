<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Photo;
use Illuminate\Http\Request;

class PhotosController extends Controller
{
    function index()
    {

    }

    function create()
    {
        return view('photos.create');
    }

    function store(Request $request)
    {
        //Tenemos que obtener las imagenes subidas

        $request->validate([
            'images'     => 'required|array|filled',
        ]);

        //Crear Modelo
        $photo = Photo::create([]);

        //Obtener el id
        $ids = collect($request->images)->pluck('id');
        //Actualizar las imagenes con el modelo que se creo
        Media::whereIn('id',$ids)->update(['model_id'=> $photo->id]);

        //Gurdar el modelo
        return response()->json(['id' => $photo->id]);
    }

    function edit(Photo $photo)
    {
        return view('photos.edit',['photo' => $photo]);
    }
}
