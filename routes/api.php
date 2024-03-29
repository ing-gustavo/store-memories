<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UploadsController;
use App\Http\Controllers\Api\DownloadsController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('downloads',DownloadsController::class);
Route::apiResource('uploads',UploadsController::class);

Route::get('downloads-get-single-file/{id}',[DownloadsController::class,'getSingleFile']);
Route::get('downloads-get-folder/{id}',[DownloadsController::class,'getFolder']);
Route::post('downloads-mark-as-downloaded/{id}',[DownloadsController::class,'markAsDownloaded']);
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
