<?php

use App\Http\Controllers\DownloadController;
use App\Http\Controllers\EnviarController;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use Laravel\Socialite\Facades\Socialite;
use App\Http\Controllers\UploadController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PhotosController;
use App\Http\Controllers\ProfileController;



Route::get('/',[HomeController::class,'index']);


Route::get('/photos/create',[PhotosController::class,'create']);
Route::post('/photos',[PhotosController::class,'store']);
Route::get('/photos/{photo}/edit',[PhotosController::class,'edit']);


Route::post('enviar',[EnviarController::class , 'store']);
Route::get('photos-confirm/{photo}',[EnviarController::class , 'confirmar']);

Route::get('downloads/{uuid}',[DownloadController::class,'show']);
Route::post('downloads/{uuid}',[DownloadController::class,'download']);

Route::get('/gallery/{gallery}',[GalleryController::class,'show']);
Route::get('/images/{gallery}',[UploadController::class,'show']);
Route::post('/upload',[UploadController::class,'store']);
Route::post('/attachToModel/{gallery}',[UploadController::class,'attachToModel']);


//Authtentificacin
Route::get('/google-auth/redirect', function () {
    return Socialite::driver('google')->redirect();
});

Route::get('/google-auth/callback', function () {

    $user = Socialite::driver('google')->user();


    $user = User::updateOrCreate([
        'google_id' => $user->id,
    ], [
        'name' => $user->name,
        'email' => $user->email,
        'avatar' => $user->avatar,
        'password' => encrypt(Str::random(5))
    ]);

    Auth::login($user);
    return redirect('/dashboard');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
