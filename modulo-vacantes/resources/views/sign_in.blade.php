@extends('layouts.app')
@section('content')
    <h2>Registrarse</h2>
    <form class="container">
        <div class="form-group col-11 col-md-6">
            <label for="nombre">Nombre:</label>
            <input type="text" class="form-control" id="nombre" required>
        </div>
        <div class="form-group col-11 col-md-6">
            <label for="apellido">Apellido:</label>
            <input type="text" class="form-control" id="apellido" required>
        </div>
        <div class="form-group col-11 col-md-6 mt-3">
            <label for="email">Correo electrónico:</label>
            <input type="email" class="form-control" id="email" required>
        </div>


    <div class="mt-2 mb-5">
        <label for="tipoDocumento" >Documento</label>
        <div class="row">
        <div class="form-group col-5 col-md-3">
            <label for="tipoDocumento">Tipo:</label>
            <select class="form-control" id="tipoDocumento" required>
                <option value="">Seleccionar</option>
                <option value="dni">DNI</option>
                <option value="pasaporte">Pasaporte</option>
                <option value="cedula">Cédula</option>
            </select>
        </div>
        <div class="form-group col-6 col-md-3">
            <label for="numeroDocumento">Número:</label>
            <input type="text" class="form-control" id="numeroDocumento" required>
        </div>
        </div>
        <div>
        <div class="form-group col-11 col-md-6">
            <label for="password">Contraseña:</label>
            <input type="password" class="form-control" id="password" required>
        </div>
        <div class="form-group col-11 col-md-6 mb-4">
            <label for="confirmPassword">Confirmar Contraseña:</label>
            <input type="password" class="form-control" id="confirmPassword" required>
        </div>
        <button type="submit" class="btn btn-primary">Registrarse</button>
    </form>
@endsection
