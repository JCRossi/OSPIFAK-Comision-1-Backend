<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{
    public function login($usuario, $password)
    {
        $cliente = DB::table('clientes')
            ->where('usuario', $usuario)
            ->where('password', $password)
            ->first();

        if ($cliente) {
            return response()->json(['message' => 'Autenticación exitosa']);
        } else {
            return response()->json(['message' => 'Credenciales incorrectas'], 401);
        }
    }
}
