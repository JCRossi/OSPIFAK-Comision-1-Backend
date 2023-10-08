<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->input('usuario');
       $password = $request->input('password');
        
        $cliente = DB::table('clientes')
            ->where('usuario', $usuario)
            ->first();

        if ($cliente) {
            return response()->json(['message' => 'Autenticación exitosa']);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas '+$usuario+' '+$password], 401);
        }
    }
}
