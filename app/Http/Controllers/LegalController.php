<?php

namespace App\Http\Controllers;

use App\Models\Photo;
use App\Notifications\Compartir;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class LegalController extends Controller
{

    function privacyPolicy()
    {
        return view('legal.privacy-policy');
    }

    function termsOfUse()
    {
        return view('legal.terms-of-use');
    }
}
