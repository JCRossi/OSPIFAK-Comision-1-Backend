<?php

namespace App\Http\Controllers;
use App\Models\Cliente;
use App\Models\Menor;
use Illuminate\Http\Request;

class ClientesMenoresController extends Controller
{
    public function index()
    {
        $ultimoCliente = Cliente::latest('id')->first();

        $menoresACargo = [];

        if ($ultimoCliente) {
            $menoresACargo = $ultimoCliente->menores;
        }

        return view('clientesMenores/index', compact('menoresACargo'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("clientesMenores/create");
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

        $fechaNacimientoMenor = $request->input('fecha_nacimiento');
        $hoy = now();
        $edadMenor = $hoy->diffInYears($fechaNacimientoMenor);

        if ($edadMenor >= 18) {
            return back()->withErrors(['fecha_nacimiento' => 'El menor a cargo debe ser menor de 18 años']);
        }

        $menor = new Menor();

        $menor->cliente_id = $clienteId;
        $menor->nombre = $request -> get('nombre'); 
        $menor->apellido = $request -> get('apellido'); 
        $menor->fecha_nacimiento = $request -> get('fecha_nacimiento'); 
        $menor->dni = $request -> get('dni');
        $menor->estado = 'Activo';

        $menor->save();
        $menor->setHidden(['created_at', 'updated_at']);
    
        return redirect()->to('/clientesMenores')->with('success', 'Menor dado de alta con éxito');
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
