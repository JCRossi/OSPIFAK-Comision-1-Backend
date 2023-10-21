<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ClientesControllerAPI;
use App\Http\Controllers\PlanesControllerAPI;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('/datos', [ClientesControllerAPI::class, 'datos']);
Route::post('/registrar', [ClientesControllerAPI::class, 'registrar']);
Route::post('/login', [ClientesControllerAPI::class, 'login']);
Route::get('/planes', [PlanesControllerAPI::class, 'index']);