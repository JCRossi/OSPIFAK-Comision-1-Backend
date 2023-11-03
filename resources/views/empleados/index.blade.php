@extends('dashboard')

@section('section_content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <div class="container">
        <a href="{{ url('/empleados/create') }}" class="d-flex justify-content-between align-items-center mb-3 text-decoration-none text-green-500">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#444444" viewBox="0 0 24 24" stroke-width="1" stroke="#444444" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                <span style="color: #78d278;" class="text-xs">Nuevo empleado</span>
            </div>
        </a>

        <table class="table table-striped mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">DNI</th>
                    <th scope="col">Nombre</th>
                    <th scope="col">Apellido</th>
                    <th scope="col">Fecha de Ingreso</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @if (isset($empleados))
                @foreach($empleados as $empleado)
                    <tr>
                        <td>{{ $empleado->dni }}</td>
                        <td>{{ $empleado->nombre }}</td>
                        <td>{{ $empleado->apellido }}</td>
                        <td>{{ $empleado->fecha_ingreso }}</td>
                        <td>
                            <!-- Agrega aquí los botones o enlaces necesarios para ver detalles del empleado, editar, etc. -->
                        </td>

                        <td>
                                <form method="POST">
                                <a href="/empleados"><i class="fas fa-edit"></i></a>
                                </form>
                        </td>
                        <td>
                            <form method="POST" action="{{ route('empleados.destroy', ['id' => $empleado->id]) }}" onsubmit="return confirm('¿Desea eliminar a {{ $empleado->nombre }}?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-primary">
                                    <i class="fas fa-trash"></i> 
                                </button>
                            </form>
                        </td>




                    </tr>

                   
                @endforeach
            @else
                <tr>
                    <td colspan="5">No se encontraron empleados.</td>
                </tr>
            @endif
            </tbody>
        </table>
    </div>
@endsection
