@extends('layouts/app')

@section('content')
<div class="container">
    <div class="card col-8 offset-2">
        <div class="card-body rounded" style="border-radius: 20px;">
            @include('messages')
            <form action="/clientes" method="POST">
                @csrf
                <div class="input-group mb-3 ">
                    <label class="form-label text" style="font-size: x-large; color: #78d278;">Titular</label>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "font-size: x-large; background-color: white;">DNI:</span>
                            <input id="dni" name="dni" type="text" class="form-control @error('dni') is-invalid @enderror bg-white" placeholder="42000000" aria-label="dni" aria-describedby="dni">
                            @error('dni')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Apellido:</span>
                            <input id="apellido" name="apellido" type="text" class="form-control @error('apellido') is-invalid @enderror bg-white" placeholder="River" aria-label="apellido" aria-describedby="apellido">
                            @error('apellido')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Nombre:</span>
                            <input id="nombre" name="nombre" type="text" class="form-control @error('nombre') is-invalid @enderror bg-white" placeholder="Plate" aria-label="nombre" aria-describedby="nombre">
                            @error('nombre')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Fecha de Nacimiento:</span>
                            <input id="fecha_nacimiento" name="fecha_nacimiento" type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror bg-white" aria-label="fecha_nacimiento" aria-describedby="fecha_nacimiento">
                            @error('fecha_nacimiento')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                        
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Email:</span>
                            <input id="email" name="email" type="text" class="form-control @error('email') is-invalid @enderror bg-white" placeholder="elpepe@gmail.com" aria-label="email" aria-describedby="email">
                            @error('email')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Dirección:</span>
                            <input type="text" id="direccion" name="direccion" class="form-control @error('direccion') is-invalid @enderror bg-white" placeholder="San Andres 800" aria-label="direccion" aria-describedby="direccion">
                            @error('direccion')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>

                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Teléfono:</span>
                            <input type="text" id="telefono" name="telefono" class="form-control @error('telefono') is-invalid @enderror bg-white" placeholder="2018091218" aria-label="telefono" aria-describedby="telefono">
                            @error('telefono')
                                <span class="tex-danger">
                                    <strong>{{$message}}</strong>
                                </span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="col-md-6 col-md-offset-15">
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Plan:</span>
                            <select class="form-select bg-white" id="plan_id" name ="plan_id">
                                @foreach($planes as $plan)
                                        <option value="{{$plan->id}}">{{$plan->nombre}}</option>
                                @endforeach
                            </select>
                        </div>
        
                        <div class="input-group mb-3">
                            <span class="input-group-text" style= "background-color: white;">Forma de Pago:</span>
                            <select name="forma_pago" id="forma_pago" class="form-select bg-white">
                                <option value="Anual">Anual</option>
                                <option value="Semestral">Semestral</option>
                                <option value="Mensual">Mensual</option>
                            </select>
                        </div>

                        <div class="input-group mb-3">        
                            <label class="form-control" style="cursor: pointer; display: inline-flex; align-items: center;">
                                <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="width: 2rem; height: 2rem; margin-right: 1rem;" viewBox="0 0 24 24" stroke-width="1" stroke="currentColor" class="w-4 h-4 mr-10">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M18.375 12.739l-7.693 7.693a4.5 4.5 0 01-6.364-6.364l10.94-10.94A3 3 0 1119.5 7.372L8.552 18.32m.009-.01l-.01.01m5.699-9.941l-7.81 7.81a1.5 1.5 0 002.112 2.13" />
                                </svg>
                                Adjuntar archivos
                                <input type="file" id="fileInput" style="display: none;" onchange="displayFileInfo()">
                            </label>
                        </div>
                        
                        <div id="fileInfo" style="margin-left: 3rem; display: none;">
                            <svg xmlns="http://www.w3.org/2000/svg" fill="none" style="width: 1.5rem; height: 1.5rem; margin-right: 0.5rem;" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-4 h-4 mr-2">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m6.75 12l-3-3m0 0l-3 3m3-3v6m-1.5-15H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                            </svg>
                              
                            <span id="fileName" style="color: #78d278;"></span>
                        </div>
                        
                        <script>
                            function displayFileInfo() {
                                const fileInput = document.getElementById('fileInput');
                                const fileInfo = document.getElementById('fileInfo');
                                const fileNameSpan = document.getElementById('fileName');
                        
                                if (fileInput.files.length > 0) {
                                    const fileName = fileInput.files[0].name;
                                    fileNameSpan.textContent = fileName;
                                    fileInfo.style.display = 'inline-flex';
                                } else {
                                    fileInfo.style.display = 'none';
                                }
                            }
                        </script>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" name="action" value="menor" class="btn btn-outline-success">+ Menor a cargo</button>
                </div>
                <div class="form-group float-end">
                    <a href="/clientes" class="btn btn-outline-primary">Cancelar</a>
                    <button type="submit" name="action" value="guardar" class="btn btn-outline-success">Guardar datos</button>
                </div>
            </form> 
        </div>
    </div>    
</div>
@endsection