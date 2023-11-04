<?php

namespace App\Http\Controllers;

use App\Models\Cliente;
use App\Models\Prestacion;
use App\Models\Menor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ClientesControllerAPI extends Controller
{

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

    public function guardarPrestacion(Request $request){
        $request -> validate(
            [
                'nombre_medico' => 'required|string|max:50',
                'matricula_medico' => 'required|string|max:50',
                'instituto' => 'required|string|max:50',
                'fecha_turno' => 'required|date',
                'comentario' => 'max:500'
            ],
            [
                'nombre_medico.required' => 'El nombre del médico no puede ser vacío',
                'nombre_medico.string' => 'El nombre del médico no tiene el formato adecuado.',
                'nombre_medico.max' => 'El nombre del médico ingresado es más extenso de lo permitido (50 caracteres).',

                'matricula_medico.required' => 'La matrícula no puede ser vacía',
                'matricula_medico.string' => 'La matrícula no tiene el formato adecuado.',
                'matricula_medico.max' => 'La matrícula ingresada es más extensa de lo permitido (50 caracteres).',
                
                'instituto.required' => 'El nombre del instituto no puede ser vacío',
                'instituto.string' => 'El nombre del instituto no tiene el formato adecuado.',
                'instituto.max' => 'El nombre del instituto ingresado es más extenso de lo permitido (50 caracteres).',

                'fecha_turno.required' => 'La fecha del turno no puede ser vacía.',
                'fecha_turno.date' => 'La fecha del turno no tiene el formato adecuado.',

                'comentario.max' => 'El comentario ingresado es más extenso de lo permitido (500 caracteres).',

             ]
        );

        $prestacion = new Prestacion();
        $prestacion->cliente_id = $request->user()->id;
        
        if($request->cliente_menor != null)
            $prestacion->cliente_menor_id = $request->cliente_menor->id;
        else
            $prestacion->cliente_menor_id = -1;
        
        $prestacion->nombre_medico = $request->nombre_medico;
        $prestacion->matricula_medico = $request->matricula_medico;
        $prestacion->instituto = $request->instituto;
        $prestacion->fecha_turno = $request->fecha_turno;
        $prestacion->fecha_solicitud = Carbon::now();
        $prestacion->estado = "Pendiente";
        $prestacion->nombre_prestacion = $request->nombre_prestacion;
        $prestacion->comentario = $request->comentario;
        $prestacion->save();

        return response()->json(['message' => 'La solicitud se realizó con éxito'], 201);
    }

    public function recuperarPrestaciones(Request $request){
        $clienteId = $request->user()->id;
        $prestaciones = Prestacion::where('cliente_id', $clienteId)->get();
        return response()->json($prestaciones);
    }

    public function recuperarMenores(Request $request){
        $clienteId = $request->user()->id;
        $menores = Menor::where('cliente_id', $clienteId)->get();
        return response()->json($menores);
    }

    public function getTitularYMenoresACargo(string $usuario){
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 405);
        }

        $menores = Menor::where('cliente_id', $cliente->id)->get();


        $titularYMenoresACargo = [
            'cliente' => $cliente,
            'menores' => $menores,
        ];
    
        return response()->json($titularYMenoresACargo);
    }

     /**
     * Soft delete the specified resource.
     */
    public function delete(string $usuario)
    {
        $cliente = Cliente::where('usuario', $usuario)->first();

        if (!$cliente) {
            return response()->json(['message' => 'Cliente no encontrado'], 404);
        }

        $cliente->estado('Inactivo');
        return response()->json(['message' => 'Baja solicitada con éxito'], 200);
    }
}