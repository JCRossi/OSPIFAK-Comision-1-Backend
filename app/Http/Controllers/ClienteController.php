<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use Illuminate\Validation\ValidationException;
use App\Models\Menor;

class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("cliente.create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate(
                [
                    'usuario' => 'required|string',
                    'password' => 'required|string',
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999',
                    'email' => 'required|email|unique:empleado,email',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|numeric',
                    'plan' => 'required|integer',
                    'menores' => 'required|array',
                    'menores.*.dni' => 'required|numeric|min:1|max:99999999',
                    'menores.*.nombre' => 'required|string|max:50',
                    'menores.*.apellido' => 'required|string|max:50',
                    'menores.*.fecha_nacimiento' => 'required|date',
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

                    'email.required' => 'El email no puede ser vacío.',
                    'email.email' => 'El email no tiene el formato adecuado.',
                    'email.unique' => 'Ya existe un empleado registrado con el email ingresado.',

                    'direccion.required' => 'La direccion no puede ser vacía',
                    'direccion.string' => 'La direccion no tiene el formato adecuado.',
                    'direccion.max' => 'La direccion ingresada es más extenso de lo permitido (50 caracteres).',

                    'telefono.required' => 'El telefono no puede ser vacío',
                    'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 

                    'plan.required' => 'El id del plan es necesario.',
                    'plan.integer' => 'El id del plan no tiene el formato adecuado.',

                    'menores.required' => 'No puede llegar un arreglo nulo.',
                    'menores.array' => 'Los menores no tienen el formato adecuado.',
                    
                    'menores.*.dni.required' => 'El DNI del menor no puede ser vacío.',
                    'menores.*.dni.numeric' => 'El DNI del menor no tiene el formato adecuado.',
                    'menores.*.dni.min' => 'El DNI del menor tiene que ser mayor que 0.',
                    'menores.*.dni.max' => 'El DNI del menor es más extenso de lo permitido (8 dígitos).',
                    
                    'menores.*.nombre.required' => 'El nombre del menor no puede ser vacío',
                    'menores.*.nombre.string' => 'El nombre del menor no tiene el formato adecuado.',
                    'menores.*.nombre.max' => 'El nombre del menor es más extenso de lo permitido (50 caracteres).',
                    
                    'menores.*.apellido.required' => 'El apellido del menor no puede ser vacío',
                    'menores.*.apellido.string' => 'El apellido del menor no tiene el formato adecuado.',
                    'menores.*.apellido.max' => 'El apellido del menor es más extenso de lo permitido (50 caracteres).',

                    'menores.*.fecha_nacimiento.required' => 'La fecha de nacimiento del menor no puede ser vacía.',
                    'menores.*.fecha_nacimiento.date' => 'La fecha de nacimiento del menor no tiene el formato adecuado.',
                ]
            );

            $cliente = new Cliente();

            $cliente -> usuario = $request -> get('usuario'); 
            $cliente -> password = $request -> get('password'); 
            $cliente -> nombre = $request -> get('nombre'); 
            $cliente -> apellido = $request -> get('apellido'); 
            $cliente -> fecha_nacimiento = $request -> get('fecha_nacimiento'); 
            $cliente -> dni = $request -> get('dni'); 
            $cliente -> email = $request -> get('email'); 
            $cliente -> direccion = $request -> get('direccion'); 
            $cliente -> telefono = $request -> get('telefono'); 
            $cliente -> plan = $request -> get('id_plan'); 

            $cliente->save();
            $cliente->setHidden(['created_at', 'updated_at']);

            foreach ($request->menores as $detalle) {
                $menor = new Menor();
                $menor->id_cliente = $cliente->id;
                $menor->nombre = $detalle['nombre'];
                $menor->apellido = $detalle['apellido'];
                $menor->fecha_nacimiento = $detalle['fecha_nacimiento'];
                $menor->dni = $detalle['dni'];
                $menor->save();
                $menor->setHidden(['created_at', 'updated_at']);
            }
            
        }
        catch(ValidationException $e) {
            $errors = $e->validator->errors()->all();
            
            return redirect()->back()->withInput()->withErrors($errors);
        }
    }

    public function cargaDeMenores(){
        return view("clienteMenor.create");
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
