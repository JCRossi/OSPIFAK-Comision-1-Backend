<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cliente;
use App\Models\Plan;
use Illuminate\Validation\ValidationException;
use App\Models\Menor;

class ClientesController extends Controller
{
    function _construct(){
        $this->middleware('can:clientes.index')->only('index');
        $this->middleware('can:clientes.create')->only('create','store');
    }

    /**
     * Display a listing of the resource.
     */
    

     public function index(Request $request)
    {
        $query = Cliente::leftJoin('plans', 'clientes.plan_id', '=', 'plans.id')
            ->select('clientes.*', 'plans.nombre as plan_nombre');

        if ($request->has('dni')) {
            $dni = $request->input('dni');
            if (!empty($dni)) {
                $query->where('dni', $dni);
            }
        }

        $clientes = $query->get();

        // Verificar si se encontraron resultados
        if ($clientes->isEmpty() && !empty($dni)) {
            // Si no se encontraron resultados y se proporcionó un DNI, muestra un mensaje
            $mensaje = "Ningún cliente coincide con el filtro aplicado.";
            return view('clientes/index', compact('mensaje'));
        }

        return view('clientes/index', compact('clientes'));
    }


     


    public function getCliente(string $id)
    {
        $cliente = Cliente::find($id);
        return view('clientes/index') -> with('clientes', $cliente);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $planes = Plan::all();
        return view("clientes/create")->with('planes', $planes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $request->validate(
                [
                    /*'usuario' => 'required|string',
                    'password' => 'required|string',*/
                    'nombre' => 'required|string|max:50',
                    'apellido' => 'required|string|max:50',
                    'fecha_nacimiento' => 'required|date',
                    'dni' => 'required|numeric|min:1|max:99999999|unique:clientes,dni',
                    'email' => 'required|email|unique:clientes,email',
                    'direccion' => 'required|string|max:100',
                    'telefono' => 'required|numeric',
                ],
                [
                   /* 'usuario.required' => 'El usuario no puede ser vacío',
                    'usuario.string' => 'El usuario no tiene el formato adecuado.',
    
                    'password.required' => 'El password no puede ser vacío.',
                    'password.string' => 'El password no tiene el formato adecuado.',*/

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

            // Verificar la edad del titular
            $fechaNacimientoTitular = $request->input('fecha_nacimiento');
            $hoy = now();
            $edadTitular = $hoy->diffInYears($fechaNacimientoTitular);

            if ($edadTitular < 18) {
                return back()->withErrors(['fecha_nacimiento' => 'El titular debe ser mayor de 18 años']);
            }

            $cliente = new Cliente();

            /*$cliente -> usuario = $request -> get('usuario'); 
            $cliente -> password = $request -> get('password');*/
            $cliente -> usuario = $request -> get('dni'); 
            $cliente -> password = $request -> get('dni'); 
            $cliente -> nombre = $request -> get('nombre'); 
            $cliente -> apellido = $request -> get('apellido'); 
            $cliente -> fecha_nacimiento = $request -> get('fecha_nacimiento'); 
            $cliente -> dni = $request -> get('dni'); 
            $cliente -> email = $request -> get('email'); 
            $cliente -> direccion = $request -> get('direccion'); 
            $cliente -> telefono = $request -> get('telefono'); 
            $cliente -> plan_id = $request -> get('plan_id');
            $cliente -> forma_pago = $request -> get('forma_pago'); 

            $cliente->save();
            $cliente->setHidden(['created_at', 'updated_at']);

            // Verificar la edad de los menores a cargo
            if ($request->has('menores')) {
                foreach ($request->input('menores') as $menorData) {
                    $fechaNacimientoMenor = $menorData['fecha_nacimiento'];
                    $edadMenor = $hoy->diffInYears($fechaNacimientoMenor);
                    if ($edadMenor >= 18) {
                        return back()->withErrors(['menores' => 'Los menores a cargo deben ser menores de 18 años']);
                    }
                }
            }

            
            
            /*return redirect()->to('/clientes')->with('success', 'Cliente dado de alta correctamente');*/

            if ($request->input('action') === 'guardar') {
                // Redirige al usuario a la página /clientes si se presionó "Guardar datos"
                return redirect()->to('/clientes')->with('success', 'Cliente dado de alta correctamente');
            } else{
                // Redirige al usuario a la página /clientesMenores si se presionó "+ Menor a cargo"
                return redirect()->to('/clientesMenores')->with('success', 'Cliente dado de alta correctamente');
            }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $cliente = Cliente::leftJoin('plans', 'clientes.plan_id', '=', 'plans.id')
        ->select('clientes.*', 'plans.nombre as plan_nombre')
        ->find($id);

        $menores = Menor::where('cliente_id', $id)->get();
        return view('clientes/show', compact('cliente', 'menores'));
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
