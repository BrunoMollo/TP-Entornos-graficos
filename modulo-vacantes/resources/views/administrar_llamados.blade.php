@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="my-4">Administración de Llamadas</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Llamada</th>
                    <th>Fecha de Cierre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>Investigacion Operativa - Auxiliar de practica</td>
                    <td>2023-07-15</td>
                    <td>
                        <button type="button" class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-danger">Cerrar</button>
                    </td>
                </tr>
                <tr>
                    <td>Teoria de control - Profesor de teoria</td>
                    <td>2023-07-20</td>
                    <td>
                        <button type="button" class="btn btn-primary">Editar</button>
                        <button type="button" class="btn btn-danger">Cerrar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
@endsection
