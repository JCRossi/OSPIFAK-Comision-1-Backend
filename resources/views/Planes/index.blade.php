@extends('dashboard')

@section('section_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="container">
        <a href="{{ url('/planes/create') }}" class="d-flex justify-content-between align-items-center mb-3 text-decoration-none text-green-500">
            <div class="d-flex align-items-center">
                <svg xmlns="http://www.w3.org/2000/svg" fill="#444444" viewBox="0 0 24 24" stroke-width="1" stroke="#444444" class="w-6 h-6">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M19 7.5v3m0 0v3m0-3h3m-3 0h-3m-2.25-4.125a3.375 3.375 0 11-6.75 0 3.375 3.375 0 016.75 0zM4 19.235v-.11a6.375 6.375 0 0112.75 0v.109A12.318 12.318 0 0110.374 21c-2.331 0-4.512-.645-6.374-1.766z" />
                </svg>
                <span style="color: #78d278;" class="text-xs">Nuevo Plan</span>
            </div>
        </a>
        <hr/>
        <style>
            .table-sm th,
            .table-sm td {
                font-weight: normal !important;        
            }
        </style>
        <div class="table-responsive">
            <table class="table table-sm table-borderless align-middle"" >
                <thead class="text-muted">
                    <tr >
                        <th></th>
                        <th scope="col" class="text-muted">#</th>
                        <th scope="col" class="text-muted">Nombre del Plan</th>
                        <th scope="col" class="text-muted">Precio Jóvenes</th>
                        <th scope="col" class="text-muted">Precio Adultos Jóvenes</th>
                        <th scope="col" class="text-muted">Precio Adultos</th>
                        <th scope="col" class="text-muted">Precio Adultos Mayores</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($planes as $plan)
                        <tr>
                            <td>
                                <a href="{{ url("/planes/{$plan->id}/edit") }}" class="btn btn-outline-primary" style="display: inline-block;">Modificar</a>
                                <button class="btn btn-outline-danger" onclick="confirmarDarDeBaja({{ $plan->id }})" style="display: inline-block;">Dar de Baja</button>
                            </td>
                            <td>{{ $plan->id }}</td>
                            <td>{{ $plan->nombre }}</td>
                            <td>{{ $plan->precio_jovenes }}</td>
                            <td>{{ $plan->precio_adultos_jovenes }}</td>
                            <td>{{ $plan->precio_adultos }}</td>
                            <td>{{ $plan->precio_adultos_mayores }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function confirmarDarDeBaja(planId) {
            if (confirm('¿Estás seguro de dar de baja el plan seleccionado?')) {
                darDeBaja(planId);
            }
        }

        function darDeBaja(planId) {
            window.location.href = `/planes/${planId}/delete`;
        }
    </script>
@endsection