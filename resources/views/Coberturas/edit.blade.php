@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="{{ route('coberturas.update', ['id' => $planId]) }}" method="POST">
            @csrf
            <input type="hidden" name="_method" value="PUT">
                <div class="container">
                    @include('messages')
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Prestación</th>
                                <th>Porcentaje</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($enumValues as $index => $prestacion)
                             <tr>
                               <td>{{ $prestacion }}</td>
                                <td>
                                    <input type="number" name="porcentaje[{{ $index }}]" value="{{ old('porcentaje.' . $index, $coberturas[$index]->porcentaje ) }}" class="form-control">
                                    @error('porcentaje.' . $index)
                                    <span class="text-danger">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                    @enderror
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <div class="form-group float-end">
                        <a href="/planes" class="btn btn-outline-primary">Cancelar</a>
                        <button type="submit" class="btn btn-outline-success">Guardar Datos</button>
                    </div>
                </div>
            </form> 
        </div>
    </div>    
</div>
@endsection
