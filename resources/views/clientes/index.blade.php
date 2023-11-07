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

        <div class="d-flex justify-content-end mb-1">
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="width: 2rem; height: 2rem; margin-right: 1rem; cursor: pointer;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-6 h-6" id="filter-icon" data-bs-toggle="modal" data-bs-target="#filterModal">
                <path stroke-linecap="round" stroke-linejoin="round" d="M10.5 6h9.75M10.5 6a1.5 1.5 0 11-3 0m3 0a1.5 1.5 0 10-3 0M3.75 6H7.5m3 12h9.75m-9.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-3.75 0H7.5m9-6h3.75m-3.75 0a1.5 1.5 0 01-3 0m3 0a1.5 1.5 0 00-3 0m-9.75 0h9.75" />
            </svg>
        </div>

        <div class="modal fade" id="filterModal" tabindex="-1" aria-labelledby="filterModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content rounded-5">
                    <div class="modal-body">
                    <form id="filterForm" method="GET" action="{{ url('/clientes') }}">
                        <div class="mb-3">
                        <div class="mb-3">
                            <label for="dniInput" class="form-label">DNI</label>
                            <input type="text" class="form-control" id="dniInput" name="dni">
                        </div>
                        <div class="mt-2">
                        <button type="submit" class="btn btn-primary btn-sm">
                        <i class="fas fa-search"></i> Buscar
                        </button>
                            <button type="button" class="btn btn-secondary btn-sm" id="clearFilter">Limpiar filtro</button>
                        </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

        <script>
            document.addEventListener('DOMContentLoaded', function () {
                var rows = document.querySelectorAll('.reintegro-row');
                var dniInput = document.getElementById('dniInput');
                var dniFilter = '';

                dniInput.addEventListener('input', function () {
                    dniFilter = dniInput.value;
                });

                rows.forEach(function (row) {
                    row.addEventListener('click', function () {
                        var url = row.getAttribute('data-url');
                        window.location.href = url;
                    });
                });

                $('#filterModal').on('show.bs.modal', function () {
                    dniInput.value = dniFilter;
                });

                $('#clearFilter').on('click', function () {
                    // Limpiar el campo de búsqueda
                    dniInput.value = '';
                    // Submit the search form to clear the filter
                    $('#filterForm').submit();
                });


                $('#filterModal').on('hidden.bs.modal', function () {
                    // Set the value of the search input in the main search form
                    $('input[name="dni"]').val(dniFilter);
                    // Submit the search form
                    $('#filterForm').submit();
                });
            });
        </script>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

        <table class="table ">
            <thead class="bg-primary text-white">
                <tr>
                    <th scope="col"></th>
                    <th scope="col">DNI titular</th>
                    <th scope="col">Apellido y nombre</th>
                    <th scope="col">Plan</th>
                    
                </tr>
            </thead>
            <tbody>
            @if (isset($mensaje))
                <tr>
                    <td colspan="4">{{ $mensaje }}</td>
                </tr>
            @else
                @foreach($clientes as $cliente)
                    <tr class="reintegro-row" data-url="/clientes/{{$cliente->id}}"style="cursor: pointer;">
                        <td>
                        <a href="/clientes/{{$cliente->id}}/edit" class="btn btn-light">
                        <i class="fas fa-pencil-alt"></i> Editar
                        </a>
                        </td>
                        <td>{{ $cliente->dni }}</td>
                        <td>{{ $cliente->apellido }} {{ $cliente->nombre }}</td>
                        <td>{{ $cliente->plan_nombre }}</td>
                       
                    </tr>
                @endforeach
            @endif
            </tbody>
        </table>
    </div>
@endsection
