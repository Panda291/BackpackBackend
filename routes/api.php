<?php

use App\Http\Controllers\BackpackController;
use App\Http\Controllers\StaticNeedController;
use App\Http\Controllers\GadgetController;
use App\Http\Controllers\DynamicNeedController;
use App\Http\Controllers\DebugController;
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

Route::controller(GadgetController::class)->group(function () {
    Route::get('/gadgets', 'index');
    Route::post('/gadgets', 'store');
    Route::get('/gadgets/{gadget}', 'show');
    Route::patch('/gadgets/{gadget}', 'update');
    Route::delete('/gadgets/{gadget}', 'destroy');
});

Route::get('/gadgets/{gadget}/switch', [DebugController::class, 'switch']);

Route::controller(StaticNeedController::class)->group(function () {
    Route::get('/static_needs', 'index');
    Route::post('/static_needs', 'store');
    Route::get('/static_needs/{dynamic_need}', 'show');
    Route::patch('/static_needs/{dynamic_need}', 'update');
    Route::delete('/static_needs/{dynamic_need}', 'destroy');
});

Route::controller(BackpackController::class)->group(function () {
    Route::post('/set_contents', 'setContents');
    Route::get('/missing', 'allPresent');
    Route::get('/needed', 'needed');
});

Route::controller(DynamicNeedController::class)->group(function () {
    Route::get('/dynamic_needs', 'index');
    Route::post('/dynamic_needs', 'store');
    Route::get('/dynamic_needs/{static_need}', 'show');
    Route::patch('/dynamic_needs/{static_need}', 'update');
    Route::delete('/dynamic_needs/{static_need}', 'destroy');
});
