@extends('layouts.app')
@section('content')
    <div class="container d-flex flex-column align-items-center">
        <h2 class="my-4">Editar Usuario</h2>
        <form>
            <div class="form-group">
                <label for="nombre">Nombre Apellido</label>
                <input type="text" class="form-control" style="width: 300px;" id="nombre" placeholder="Cristian Bigatti">
            </div>
            <div class="form-group">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control" style="width: 300px;" id="email" placeholder="cbigatti@gmail.com">
            </div>
            <div class="form-group">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control" style="width: 300px;" id="password" placeholder="stereolove">
            </div>
            <div class="form-group mt-4">
                <button type="submit" class="col-4 btn btn-secondary mr-2" style="width: 100px;">Cancelar</button>
                <button type="button" class="col-4 btn btn-primary mr-2" style="width: 100px;">Guardar</button>
                <button type="button" class="col-4 btn btn-danger" style="width: 100px;">Eliminar</button>
            </div>
        </form>
    </div>
@endsection
