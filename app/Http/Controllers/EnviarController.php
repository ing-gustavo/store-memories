<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Notifications\Compartir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class EnviarController extends Controller
{
    //

    function store(Request $request)
    {
        $request->validate([
            'model_id' => 'required|numeric',
            'from' => 'required|email:rfc,dns',
            'to' => 'required|email:rfc,dns',
            'title' => 'required',
            'message' => 'required',
        ]);

        //Pide codigo de verifacion antes de enviar el correo
        $model = Photo::findOrFail($request->model_id);

        $model->from = $request->from;
        $model->to = $request->to;
        $model->title = $request->title;
        $model->message = $request->message;
        $model->uuid = Str::uuid()->toString();
        $model->save();


        //Enviar correo

        Notification::route('mail', $model->to)->notify(new Compartir($model));


        return response()->json(['message' => 'Success','uuid' => $model->uuid], 200);

    }

    function confirmar(Photo $photo)
    {
        return view('photos.confirm',['photo' => $photo]);
    }
}
