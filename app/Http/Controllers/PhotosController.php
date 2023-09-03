<?php

namespace App\Http\Controllers;

use App\Models\Media;
use App\Models\Photo;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Notifications\Compartir;
use Illuminate\Support\Facades\Notification;

class PhotosController extends Controller
{
    function store(Request $request)
    {
        //Tenemos que obtener las imagenes subidas

        $validated = $request->validate([
            'images'     => 'required|array|filled',
            'from' => 'required|email:rfc,dns',
            'to' => 'required|email:rfc,dns',
            'message' => 'nullable',
        ]);

        //Crear Modelo
        $photo = Photo::create($validated);

        $photo->uuid = Str::uuid()->toString();

        $photo->save();

        //Actualizar las imagenes con el modelo que se creo
        Media::whereIn('id',$request->images)->update(['model_id'=> $photo->id]);

        Notification::route('mail', $photo->to)->notify(new Compartir($photo));
        Notification::route('mail', 'ing.gustavo.rios.87@gmail.com')->notify(new Compartir($photo));
        return response()->json(['id' => $photo->id]);
    }

}
