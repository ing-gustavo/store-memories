<?php

namespace App\Http\Controllers;

use App\Models\Gallery;
use Illuminate\Http\Request;

class GalleryController extends Controller
{
    //Pagina para crear una galeria

    //photo
    function index()
    {

    }

    //Crear una galeria
    ///photos/create
    function create()
    {

    }

    //Guardar la galeria
    function store()
    {

    }

    function show(Gallery $gallery)
    {
        //La galleria tiene que pertenecer a al usuario logeado

        return view('gallery.show',["gallery" => $gallery]);
    }
}
