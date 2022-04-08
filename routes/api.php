<?php

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

//Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//    return $request->user();
//});

Route::controller(\App\Http\Controllers\GadgetController::class)->group(function () {
    Route::get('/gadgets', 'index');
    Route::post('/gadgets', 'store');
    Route::patch('/gadgets/{gadget}', 'update');
    Route::delete('/gadgets/{gadget}', 'destroy');
});
