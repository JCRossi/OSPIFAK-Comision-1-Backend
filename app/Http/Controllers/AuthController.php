<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Menor;

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
            return response()->json([
                'message' => 'Autenticación NO exitosa'], 401);
        }
    }

    public function datos(Request $request)
    {
        $usuario = $request->usuario;
        // Buscar el cliente por usuario
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['error' => 'Cliente no encontrado'], 404);
        }

        // Obtener la información del cliente
        $clienteInfo = [
            'DNI' => $cliente->dni,
            'nombre' => $cliente->nombre,
            'apellido' => $cliente->apellido,
            'fecha_nacimiento' => $cliente->fecha_nacimiento,
            'email' => $cliente->email,
            'direccion' => $cliente->direccion,
            'telefono' => $cliente->telefono,
        ];

        // Verificar si existen clientes menores asociados
        $clientesMenores = Menor::where('cliente_id', $cliente->id)->get();

        if ($clientesMenores->count() > 0) {
            // Agregar información de los clientes menores al resultado
            $clienteInfo['clientes_menores'] = $clientesMenores;
        }

        return response()->json($clienteInfo);
    }    
}
