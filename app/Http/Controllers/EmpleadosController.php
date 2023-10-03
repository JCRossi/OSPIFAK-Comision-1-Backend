<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Empleado;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class EmpleadosController extends Controller
{
    function _construct(){
        $this->middleware('can:empleados.index')->only('index');
        $this->middleware('can:empleados.create')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('empleados/index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("empleados/create");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
 
            $request->validate(
                [
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999',
                    'email' => 'required|email|unique:empleados,email',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|numeric',
                    'fecha_ingreso' => 'required|date',
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

                    'email.required' => 'El email no puede ser vacío.',
                    'email.email' => 'El email no tiene el formato adecuado.',
                    'email.unique' => 'Ya existe un empleado registrado con el email ingresado.',

                    'direccion.required' => 'La direccion no puede ser vacía',
                    'direccion.string' => 'La direccion no tiene el formato adecuado.',
                    'direccion.max' => 'La direccion ingresada es más extenso de lo permitido (50 caracteres).',

                    'telefono.required' => 'El telefono no puede ser vacío',
                    'telefono.numeric' => 'El telefono no tiene el formato adecuado.', 

                    'fecha_ingreso.required' => 'La fecha de ingreso no puede ser vacía.',
                    'fecha_ingreso.date' => 'La fecha de ingreso no tiene el formato adecuado.',
                ]
            );

            $empleado = new Empleado();
            $empleado -> usuario = $request -> get('dni'); 
            $empleado -> password = $request -> get('dni'); 
            $empleado -> nombre = $request -> get('nombre'); 
            $empleado -> apellido = $request -> get('apellido'); 
            $empleado -> fecha_nacimiento = $request -> get('fecha_nacimiento'); 
            $empleado -> dni = $request -> get('dni'); 
            $empleado -> email = $request -> get('email'); 
            $empleado -> direccion = $request -> get('direccion'); 
            $empleado -> telefono = $request -> get('telefono'); 
            $empleado -> fecha_ingreso = $request -> get('fecha_ingreso'); 

            $empleado->save();
            
        return redirect()->to('/empleados')->with('success', 'Empleado dado de alta correctamente');
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
