@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            <h1>Menores a Cargo</h1>
            
            @if (count($menoresACargo) > 0)
                <ul>
                    @foreach ($menoresACargo as $menor)
                        <li>{{ $menor->nombre }} {{ $menor->apellido }}</li>
                    @endforeach
                </ul>
            @else
                <p>Aún no tiene menores a cargo.</p>
            @endif
            
            <div class="form-group mt-4">
                <a href="/clientesMenores/create" class="btn btn-outline-success">Agregar Menor a Cargo</a>
                <a href="/clientes" class="btn btn-outline-success">Guardar Todo y Terminar</a>
            </div>
        </div>
    </div>
</div>
@endsection

