<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //
    function index()
    {
        //Crear un nuevo
        return view('app');
    }
}
