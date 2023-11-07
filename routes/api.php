<?php

use App\Http\Controllers\ClientesController;
use App\Http\Controllers\SolicitudesBajaControllerAPI;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
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


Route::post('/login', [ClientesControllerAPI::class, 'login']);
Route::get('/datos', [ClientesControllerAPI::class, 'datos']);
Route::post('/registrar', [ClientesControllerAPI::class, 'registrar']);
//Route::get('/planes', [PlanesControllerAPI::class, 'index']);

Route::post('/prestaciones', [ClientesControllerAPI::class, 'recuperarPrestaciones']);
Route::post('/prestaciones/solicitudes', [ClientesControllerAPI::class, 'guardarPrestacion']);
Route::post('/menores', [ClientesControllerAPI::class, 'recuperarMenores']);
Route::post('/plan', [ClientesControllerAPI::class, 'recuperarPlan']);

Route::get('/reintegros/{clienteUsuario}',[ReintegrosControllerAPI::class,'getReintegrosByClient']);
Route::post('/reintegros',[ReintegrosControllerAPI::class,'store']);
Route::post('/clientes/delete', [ClientesControllerAPI::class, 'delete']);
Route::get('/clientes/{usuario}/titularYMenoresACargo', [ClientesControllerAPI::class, 'getTitularYMenoresACargo']);

Route::post('/solicitudesBaja', [SolicitudesBajaControllerAPI::class, 'store']);
Route::get('/solicitudesBaja/{cliente_usuario}', [SolicitudesBajaControllerAPI::class, 'index']);

Route::post('/registrarMenor', [ClientesControllerAPI::class, 'registrarMenor']);
Route::post('/login', [ClientesControllerAPI::class, 'login']);
Route::get('/planes', [PlanesControllerAPI::class, 'index']);
