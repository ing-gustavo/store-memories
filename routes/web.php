<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotosController;
Route::get('/',[HomeController::class,'index']);

Route::post('/photos',[PhotosController::class,'store']);

Route::get('{any}', function () {
    return view('app');
})->where('any','.*');

require __DIR__.'/auth.php';
