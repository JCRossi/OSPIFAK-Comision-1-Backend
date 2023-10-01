<div class="form-group mb-3">
    <label class="form-label"style="font-size: 30px;">Nombre</label>
    <input type="text" name="nombre"  class="form-control @error('nombre') is-invalid @enderror bg-white" >

</div>

<label class="form-label"  style="font-size: 30px;" for="precio">Precios</label>

<div class="form-group mb-3">
    <label class="form-label" for="precio_jovenes">Menores de 21 años</label>
    <input type="text" name="precio_jovenes" class="form-control @error('precio_jovenes') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label" for="precio_adultos_jovenes">De 21 a 35 años</label>
    <input type="text" name="precio_adultos_jovenes" class="form-control @error('precio_adultos_jovenes') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label" for="precio_adultos">de 35 a 55 años</label>
    <input type="text" name="precio_adultos" class="form-control @error('precio_adultos') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label" for="precio_adultos_mayores">Mayores a 55 años</label>
    <input type="text" name="precio_adultos_mayores" class="form-control @error('precio_adultos_mayores') is-invalid @enderror bg-white" >
</div>

<div class="form-group mb-3">
    <label class="form-label" for="descripcion"style="font-size: 30px;">Coberturas</label>
    <br>
    <a href="/planes" class="btn btn-warning">Coberturas</a>
</div>



<div class="form-group d-flex justify-content-end">
    <a href="/planes" class="btn btn-info mx-2">Cancelar</a>
    <a type="submit" class="btn btn-success mx-2">Guardar datos</a>
</div>