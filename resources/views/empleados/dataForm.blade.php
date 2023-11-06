@php
    use App\Models\Empleado;
@endphp

<h2 class="text-center mt-3 mb-4" style="color: #78d278;">Alta empleado</h2>
<div class="container">
            @include('messages')
            <form action="/empleados" method="POST">
                @csrf
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <label class="form-label text" style= "font-size: x-large;">DNI:</label>
                            <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror bg-white" >
                            @error('dni')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="form-group mb-3">
                            <label class="form-label">Apellido:</label>
                            <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror bg-white" >
                            @error('apellido')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Nombre:</label>
                            <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror bg-white" >
                            @error('nombre')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Fecha de Nacimiento:</label>
                            <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror bg-white" >
                            @error('fecha_nacimiento')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="form-group mb-3">
                            <label class="form-label">Fecha de Ingreso:</label>
                            <input type="date" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror bg-white" >
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
                            <input type="email" name="email" class="form-control @error('email') is-invalid @enderror bg-white" >
                            @error('email')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Dirección:</label>
                            <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror bg-white">
                            @error('direccion')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group mb-3">
                            <label class="form-label">Teléfono:</label>
                            <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror bg-white" >
                            @error('telefono')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="form-group float-end">
                <a href="/empleados" class="btn btn-outline-primary">
                <span class="fas fa-arrow-left"></span> Volver
                </a>
                <button type="submit" class="btn btn-outline-success">
                <i class="fas fa-save"></i> Guardar datos
                </button>

                </div>
            </form>
</div>
