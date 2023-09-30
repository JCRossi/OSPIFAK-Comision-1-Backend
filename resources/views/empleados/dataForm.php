
<h2 class="text-center text-success mt-3 mb-4">Alta empleado</h2>

<div class="form-group mb-3">
    <label class="form-label text">DNI:</label>
    <input type="text" name="dni" class="form-control @error('dni') is-invalid @enderror bg-white" >

</div>

<div class="form-group mb-3">
    <label class="form-label">Apellido:</label>
    <input type="text" name="apellido" class="form-control @error('apellido') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label">Nombre:</label>
    <input type="text" name="nombre" class="form-control @error('nombre') is-invalid @enderror bg-white" >
</div>


<div class="form-group mb-3">
    <label class="form-label">Fecha de Nacimiento:</label>
    <input type="date" name="fecha_nacimiento" class="form-control @error('fecha_nacimiento') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label">Fecha de Ingreso:</label>
    <input type="date" name="fecha_ingreso" class="form-control @error('fecha_ingreso') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label">Dirección:</label>
    <input type="text" name="direccion" class="form-control @error('direccion') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label">Teléfono:</label>
    <input type="text" name="telefono" class="form-control @error('telefono') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label">Email:</label>
    <input type="email" name="email" class="form-control @error('email') is-invalid @enderror bg-white" >

</div>


<div class="form-group">
    <a href="/dashboard" class="btn btn-info">Cancelar</a>
    <button type="submit" class="btn btn-success">Guardar datos</button>
</div>
