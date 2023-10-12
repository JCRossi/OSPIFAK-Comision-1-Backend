<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientesControllerAPI extends Controller
{

    public function registrar(Request $request)
    {
     /*       $request->validate(
                [
                    'usuario' => 'required|string',
                    'password' => 'required|string',
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999|unique:clientes,dni',
                    'email' => 'required|email|unique:clientes,email',
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
                    'dni.unique' => 'Ya existe un cliente registrado con el email ingresado.',

                    'email.required' => 'El email no puede ser vacío.',
                    'email.email' => 'El email no tiene el formato adecuado.',
                    'email.unique' => 'Ya existe un empleado registrado con el email ingresado.',

                    'direccion.required' => 'La direccion no puede ser vacía',
                    'direccion.string' => 'La direccion no tiene el formato adecuado.',
                    'direccion.max' => 'La direccion ingresada es más extenso de lo permitido (50 caracteres).',

                    'telefono.required' => 'El telefono no puede ser vacío',
                    'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 

                 ]
            );
*/
            $cliente = DB::table('clientes')->where('dni', $request -> dni)->first();
            if ($cliente) {
                return response()->json(['error' => 'El cliente con DNI ' . $request -> dni . ' ya existe.'], 404);
            }

            $cliente = new Cliente();
            /*$cliente -> usuario = $request -> usuario'); 
            $cliente -> password = $request -> password');*/
            $cliente -> usuario = $request -> dni; 
            $cliente -> password = $request -> dni; 
            $cliente -> nombre = $request -> nombre; 
            $cliente -> apellido = $request -> apellido; 
            $cliente -> fecha_nacimiento = $request -> fecha_nacimiento; 
            $cliente -> dni = $request -> dni; 
            $cliente -> email = $request -> email; 
            $cliente -> direccion = $request -> direccion; 
            $cliente -> telefono = $request -> telefono; 
            $cliente -> plan_id = $request -> plan_id;
            $cliente -> forma_pago = $request -> forma_pago; 
            $cliente->save();
            $cliente->setHidden(['created_at', 'updated_at']);
            return response()->json(['message' => 'El cliente fue creado con éxito'], 201);
    }
}
