@extends('dashboard')

@section('section_content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    <div class="container mt-4">
        <!-- Botones -->
        <div class="d-flex mb-4" style="margin-right: -8px;"> <!-- Agrega un margen negativo para compensar el último botón -->
            <a href="{{ url('/solicitudes/prestaciones') }}" class="btn btn-outline-secondary" style="margin-right: 8px;">Prestaciones</a>
            <a href="{{ url('/solicitudes/reintegros') }}" class="btn btn-outline-secondary" style="margin-right: 8px;">Reintegros</a>
            <a href="{{ url('/solicitudes/bajas') }}" class="btn btn-outline-secondary">Bajas</a>
        </div>
        @yield('tipoDeSolicitud_content')
    </div>
    
    <script>
        // Script para cambiar el estilo del botón según la ruta actual
        document.addEventListener('DOMContentLoaded', function () {
            var buttons = document.querySelectorAll('.btn-outline-secondary');
    
            // Obtén la ruta actual sin el dominio
            var currentPath = window.location.pathname;
    
            buttons.forEach(function (button) {
                // Obtén la ruta asociada al botón sin el dominio
                var buttonPath = new URL(button.href).pathname;
    
                if (currentPath === buttonPath) {
                    // Agrega la clase 'btn-outline-success' y 'disabled' al botón correspondiente
                    button.classList.add('btn-outline-success', 'disabled');
                }
    
                button.addEventListener('click', function () {
                    // Elimina la clase 'btn-success' de todos los botones
                    buttons.forEach(function (btn) {
                        btn.classList.remove('btn-outline-success', 'disabled');
                    });
    
                    // Agrega la clase 'btn-success' y 'disabled' al botón presionado
                    button.classList.add('btn-outline-success', 'disabled');
                });
            });
        });
    </script> 
@endsection