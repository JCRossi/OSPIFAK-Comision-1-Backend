<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use App\Models\Menor;


class ClientesControllerAPI extends Controller
{
     public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'usuario' => ['required','string'],
            'password' => ['required','string']
        ]);

        if ($validator->fails()){
            return response()->json(['errors' => $validator->errors()],401);
        }

       // if (!Auth::guard('clientes')->attempt($request->only(['usuario','password']))){
         //   return response()->json(['error' => 'Invalid usuario or password'],401);
       // }  

        $cliente = Cliente::where('usuario', $request->usuario)->first();
        $cliente->setHidden(['created_at', 'updated_at']);
        $token = $cliente->createToken('myapptoken')->plainTextToken;

        return response()->json([
            'usuario' => $cliente,
            'token' => $token
        ],200);
    }
   


    public function registrar(Request $request)
    {
            $request->validate(
                [
                    'usuario' => 'required|string',
                    'password' => 'required|string',
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999|unique:clientes,dni',
                    'email' => 'required|email',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|numeric',
                ],
                [
                    'usuario.required' => 'El usuario no puede ser vacío',
                    'usuario.string' => 'El usuario no tiene el formato adecuado.',
    
                    'password.required' => 'El password no puede ser vacío.',
                    'password.string' => 'El password no tiene el formato adecuado.',

                    'nombre.required' => 'El nombre no puede ser vacío',
                    'nombre.string' => 'El nombre no tiene el formato adecuado.',
                    'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                    'apellido.required' => 'El apellido no puede ser vacío',
                    'apellido.string' => 'El apellido no tiene el formato adecuado.',
                    'apellido.max' => 'El apellido ingresado es más extenso de lo permitido (50 caracteres).',
                    
                    'fecha_nacimiento.required' => 'La fecha de nacimiento no puede ser vacía.',
                    'fecha_nacimiento.date' => 'La fecha de nacimiento no tiene el formato adecuado.',

                    'dni.required' => 'El DNI no puede ser vacío.',
                    'dni.numeric' => 'El DNI no tiene el formato adecuado.',
                    'dni.min' => 'El DNI ingresado tiene que ser mayor que 0.',
                    'dni.max' => 'El DNI ingresado es más extenso de lo permitido (8 dígitos).',
                    'dni.unique' => 'Ya existe un cliente registrado con el DNI ingresado.',

                    'email.required' => 'El email no puede ser vacío.',
                    'email.email' => 'El email no tiene el formato adecuado.',

                    'direccion.required' => 'La direccion no puede ser vacía',
                    'direccion.string' => 'La direccion no tiene el formato adecuado.',
                    'direccion.max' => 'La direccion ingresada es más extenso de lo permitido (50 caracteres).',

                    'telefono.required' => 'El telefono no puede ser vacío',
                    'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 

                 ]
            );

            $cliente = DB::table('clientes')->where('dni', $request -> dni)->first();
            if ($cliente) {
                return response()->json(['error' => 'El cliente con DNI ' . $request -> dni . ' ya existe.'], 404);
            }

            $cliente = new Cliente();
            $cliente -> usuario = $request->dni; 
            $cliente -> password = $request->dni; 
            $cliente -> nombre = $request->nombre; 
            $cliente -> apellido = $request->apellido; 
            $cliente -> fecha_nacimiento = $request->fecha_nacimiento; 
            $cliente -> dni = $request->dni; 
            $cliente -> email = $request->email; 
            $cliente -> direccion = $request->direccion; 
            $cliente -> telefono = $request -> telefono; 
            $cliente -> plan_id = $request -> plan_id;
            $cliente -> forma_pago = $request -> forma_pago;  
            $cliente->save();
            $cliente->setHidden(['created_at', 'updated_at']);
            
            return response()->json(['message' => 'El cliente fue creado con éxito'], 201);
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


    public function registrarMenor(Request $request)
    {
        $request->validate(
            [
                'nombre' => 'required|string|max:50',
                'apellido' => 'required|string|max:50',
                'fecha_nacimiento' => 'required|date',
                'dni' => 'required|numeric|min:1|max:99999999|unique:cliente_menor,dni',
            ],
            [
                'nombre.required' => 'El nombre no puede ser vacío',
                'nombre.string' => 'El nombre no tiene el formato adecuado.',
                'nombre.max' => 'El nombre ingresado es más extenso de lo permitido (50 caracteres).',

                'apellido.required' => 'El apellido no puede ser vacío',
                'apellido.string' => 'El apellido no tiene el formato adecuado.',
                'apellido.max' => 'El apellido ingresado es más extenso de lo permitido (50 caracteres).',
                
                'fecha_nacimiento.required' => 'La fecha de nacimiento no puede ser vacía.',
                'fecha_nacimiento.date' => 'La fecha de nacimiento no tiene el formato adecuado.',

                'dni.required' => 'El DNI no puede ser vacío.',
                'dni.numeric' => 'El DNI no tiene el formato adecuado.',
                'dni.min' => 'El DNI ingresado tiene que ser mayor que 0.',
                'dni.max' => 'El DNI ingresado es más extenso de lo permitido (8 dígitos).',
                'dni.unique' => 'Ya existe un menor registrado con el email ingresado.',

            ]
        );

        $clienteId = Cliente::max('id');

        $menor = new Menor();

        $menor->cliente_id = $clienteId;
        $menor->nombre = $request -> get('nombre'); 
        $menor->apellido = $request -> get('apellido'); 
        $menor->fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $menor->dni = $request -> get('dni');

        $menor->save();
        $menor->setHidden(['created_at', 'updated_at']);
    
        return response()->json(['message' => 'El menor fue creado con éxito'], 201);
    }

}
