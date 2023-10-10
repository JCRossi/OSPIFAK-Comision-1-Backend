@extends('/dashboardEmpleado')
@section('section_content')
    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif
    <div class="container">
        <a href="{{ url('/clientes/create') }}" class="d-flex justify-content-between align-items-center mb-3 text-decoration-none text-green-500">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#444444" viewBox="0 0 24 24" stroke-width="1" stroke="#444444" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                <span style="color: #78d278;" class="text-xs">Nuevo cliente</span>
            </div>
        </a>

        <form method="GET" action="{{ url('/clientes') }}" class="mb-4">
            <div class="input-group">
                <input type="text" name="dni" class="form-control" placeholder="Buscar por DNI" value="{{ request('dni') }}">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>

        <table class="table table-striped mt-4">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col">DNI titular</th>
                    <th scope="col">Apellido y nombre</th>
                    <th scope="col">Plan</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody>
            @if (isset($mensaje))
                <tr>
                    <td colspan="4">{{ $mensaje }}</td>
                </tr>
            @else
                @foreach($clientes as $cliente)
                    <tr>
                        <td>{{ $cliente->dni }}</td>
                        <td>{{ $cliente->apellido }} {{ $cliente->nombre }}</td>
                        <td>{{ $cliente->plan_nombre }}</td>
                        <td>
                            <a href="/clientes/{{$cliente->id}}" class="btn btn-light">Detalle</a>
                        </td>
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection