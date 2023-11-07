<?php

use App\Http\Controllers\SolicitudesBajaControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClientesControllerAPI;
use App\Http\Controllers\PlanesControllerAPI;
use App\Http\Controllers\ReintegrosControllerAPI;

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


Route::post('/login', [AuthController::class, 'login']);
Route::get('/datos', [AuthController::class, 'datos']);
Route::post('/registrar', [ClientesControllerAPI::class, 'registrar']);
Route::get('/planes', [PlanesControllerAPI::class, 'index']);

Route::middleware(['auth:sanctum'])->group(function() {
    Route::get('/prestaciones', [ClienteControllerAPI::class, 'recuperarPrestaciones']);
    Route::post('/prestaciones/solicitudes', [ClienteControllerAPI::class, 'guardarPrestacion']);
    Route::get('/menores', [ClienteControllerAPI::class, 'recuperarMenores']);

});

Route::get('/reintegros/{clienteUsuario}',[ReintegrosControllerAPI::class,'getReintegrosByClient']);
Route::post('/reintegros',[ReintegrosControllerAPI::class,'store']);
Route::post('/clientes/delete', [ClientesControllerAPI::class, 'delete']);
Route::get('/clientes/{usuario}/titularYMenoresACargo', [ClientesControllerAPI::class, 'getTitularYMenoresACargo']);

Route::post('/solicitudesBaja', [SolicitudesBajaControllerAPI::class, 'store']);
Route::get('/solicitudesBaja/{cliente_usuario}', [SolicitudesBajaControllerAPI::class, 'index']);