<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Menor;
use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class AuthController extends Controller
{
    public function login(Request $request) {
        try{
            $jsonResponse = null;
        
            if($this->usuarioValido($request)) {
                $usuario = Cliente::where('usuario', $request->usuario)->first();
    
                $jsonResponse = $this->success([
                    'usuario' => $usuario,
                    'token' => $usuario->createToken('Api token of '. $usuario->usuario)->plainTextToken
                ], 'Cliente logueado correctamente', 200);
            }
            else {
                $jsonResponse = $this->error('', 'DNI o contraseña incorrectos', 401);
            }

            return $jsonResponse;
        } catch(ValidationException $e){
            $errors = $e->validator->errors()->all();

            return $jsonResponse = $this->error('', ['errors' => $errors], 422);
        }
    }

    private function usuarioValido($request) {
        return Auth::guard('clientes')->attempt([
            "usuario" => $request->usuario, 
            "password" => $request->password
        ]);
    }

    


    /*public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usuario' => ['required','string'],
            'password' => ['required','string']
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()],401);
        }

        if (!Auth::guard('clientes')->attempt($request->only(['usuario','password']))){
            return response()->json(['error' => 'Invalid usuario or password'],401);
        }  

        $cliente = Cliente::where('usuario', $request->usuario)->first();
        $cliente->setHidden(['created_at', 'updated_at']);
        $token = $cliente->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'cliente' => $cliente,
            'token' => $token
        ],200);
    }*/




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
