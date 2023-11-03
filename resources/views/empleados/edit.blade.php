@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
        <h2 class="text-center mt-3 mb-4" style="color: #78d278;">Editar empleado</h2>

            @include('messages')
            <form action="/empleados/{{ $empleados->id }}" method="POST">
                @csrf
                @method('PUT')  {{-- Agregar esto para indicar que es una actualización --}}
                
            
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label text" style= "font-size: x-large;">DNI:</label>
                            <input id="dni" type="text" name="dni" value={{$empleados->dni}} class="form-control @error('dni') is-invalid @enderror bg-white" >
                            @error('dni')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Apellido:</label>
                            <input id="apellido" type="text" name="apellido" value={{$empleados->apellido}} class="form-control @error('apellido') is-invalid @enderror bg-white" >
                            @error('apellido')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Nombre:</label>
                            <input id="nombre" type="text" name="nombre" value={{$empleados->nombre}} class="form-control @error('nombre') is-invalid @enderror bg-white" >
                            @error('nombre')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Fecha de Nacimiento:</label>
                            <input id="fecha_nacimiento" type="date" name="fecha_nacimiento" value={{$empleados->fecha_nacimiento}} class="form-control @error('fecha_nacimiento') is-invalid @enderror bg-white" >
                            @error('fecha_nacimiento')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Fecha de Ingreso:</label>
                            <input id="fecha_ingreso" type="date" name="fecha_ingreso" value={{$empleados->fecha_ingreso}} class="form-control @error('fecha_ingreso') is-invalid @enderror bg-white" >
                            @error('fecha_ingreso')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>

                    <div class="col-md-6 col-md-offset-15">
                        <div class="form-group mb-3">
                            <label class="form-label">Email:</label>
                            <input id="email"  type="email" name="email" value={{$empleados->email}} class="form-control @error('email') is-invalid @enderror bg-white" >
                            @error('email')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Dirección:</label>
                            <input id="direccion" type="text" name="direccion" value={{$empleados->direccion}} class="form-control @error('direccion') is-invalid @enderror bg-white">
                            @error('direccion')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input id="telefono" type="text" name="telefono" value={{$empleados->telefono}} class="form-control @error('telefono') is-invalid @enderror bg-white" >
                            @error('telefono')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group float-end">
                    <a href="/empleados" class="btn btn-outline-primary">Cancelar</a>
                    <button type="submit" class="btn btn-outline-success">Guardar datos</button>
                </div>
            </form>





            </form> 
        </div>
    </div>    
</div>
@endsection