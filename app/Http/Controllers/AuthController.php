<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $usuario = $request->usuario;
       $password = $request->password;
        
        $cliente = DB::table('clientes')
            ->where('usuario', $usuario)
            ->where('password', $password)
            ->first();

        if ($cliente) {
            return response()->json(['message' => 'Autenticación exitosa']);
        } else {
            return response()->json(['message' => 'Autenticación NO exitosa'], 401);
        }
    }
}
