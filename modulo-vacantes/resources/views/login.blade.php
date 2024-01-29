@extends('layouts.app')

@section('content')
<div class="row justify-content-center pt-4 pb-5">
    <div class="col-md-6">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title text-center">Inicio de sesión</h4>
                <form class="card-body">
                    <div class="mt-4 form-group">
                        <label for="email">Correo electrónico</label>
                        <input required type="email" class="form-control" id="email"
                            placeholder="Ingresa tu correo electrónico">
                    </div>
                    <div class="mt-2 form-group">
                        <label for="password">Contraseña</label>
                        <input required type="password" class="form-control" id="password" placeholder="Contraseña">
                    </div>
                    <div class="row">
                        <button type="submit"
                            class="col-10 offset-1 col-sm-5 offset-sm-6 mt-3 btn btn-primary btn-block">Iniciar
                            sesión</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
