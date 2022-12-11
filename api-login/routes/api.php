<?php

use App\Http\Controllers\EpresenceController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('login', [App\Http\Controllers\AuthController::class,'login']);
// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['prefix'=> 'auth', 'middleware'=>'auth:sanctum'], function (){
    Route::apiResource('/absen',App\Http\Controllers\EpresenceController::class);
    Route::post('in', [EpresenceController::class,'in'])->name('in');
    Route::post('out', [EpresenceController::class,'out'])->name('out');
    Route::post('approve/', [EpresenceController::class,'approve'])->name('approve');
});