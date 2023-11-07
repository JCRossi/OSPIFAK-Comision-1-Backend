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

            .btn-borderless {
                border: none;
                background: none;
            }
        </style>
        <div class="table-responsive">
            <table class="table table-sm table-borderless">
                <tbody>
                    @foreach ($planes as $plan)
                        <tr>
                            <td style="width:120px;" class="text-left">
                                <a href="{{ url("/planes/{$plan->id}/edit") }}" class="btn btn-outline-primary btn-borderless" style="display: inline-block;"><i class="fas fa-pencil-alt"></i></a>
                                <button class="btn btn-outline-danger btn-borderless" onclick="confirmarDarDeBaja({{ $plan->id }})" style="display: inline-block;"><i class="fas fa-trash-alt"></i></button>
                            </td>
                            <td onclick="window.location.href='{{ url("/planes/{$plan->id}/edit") }}';" style="cursor: pointer;">{{ $plan->nombre }}</td>
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
    <div class="table-responsive">
        <table class="table" id="prestaciones-table">
        @foreach ($planes as $planActual)
            <tr class="planes-row" data-url="/planes/{{ $planActual->id }}">
                <td style="text-align: left;">{{ $planActual->nombre }}</td>
                <td>
                        <form method="POST">
                        <a href="/planes/edit/{{ $planActual->id }}"><i class="fas fa-edit"></i></a>
                        </form>
                </td>
            </tr>
        @endforeach
        </table>
    </div>

    <style>
        .planes-row {
            cursor: pointer;
        }
    </style>


@endsection
