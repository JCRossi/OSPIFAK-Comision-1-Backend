@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="/coberturas/update" method="POST">
                @csrf
                
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
                                <input type="number" name="porcentaje[{{ $index }}]" value="{{$cobertura->porcentaje[{{ $index }}]}}" class="form-control" value="{{ old('porcentaje.' . $index) }}">
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
                <a href="/planes/edit" class="btn btn-outline-primary">Cancelar</a>
                <button type="submit" class="btn btn-outline-success">Guardar Datos</button>
            </div>

            </form> 
        </div>
    </div>    
</div>
@endsection