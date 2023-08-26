<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Artesaos\SEOTools\Facades\SEOTools;

class HomeController extends Controller
{
    //
    function index()
    {
        SEOTools::webPage('Compartir Imágenes Grandes Gratis Sin Límites de Tamaño: Comparte y Descarga Fotos a Cualquier Escala"', '¡Libertad para compartir en grande! Nuestra plataforma de intercambio de imágenes te brinda la posibilidad  de compartir fotos de cualquier tamaño. Sin restricciones, sin límites. Sube tus imágenes y elige los destinatarios para que disfruten de descargas sin complicaciones. Únete ahora y experimenta la conveniencia de compartir recuerdos visuales sin restricciones de tamaño en cada click.');
        //Crear un nuevo
        return view('home');
    }
}
