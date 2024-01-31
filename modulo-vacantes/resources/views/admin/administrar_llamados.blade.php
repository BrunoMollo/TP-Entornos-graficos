@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Administración de Llamados</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Catedra</th>
                    <th>Puesto</th>
                    <th>Descripción</th>
                    <th>Fecha de Cierre</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($llamados as $llamado)
                    <tr>
                        <td>{{ $llamado->catedra->nombre }}</td>
                        <td>{{ $llamado->puesto }}</td>
                        <td>{{ $llamado->descripcion }}</td>
                        <td>{{ $llamado->fecha_cierre }}</td>
                        <td>
                            <a href="#" class="btn btn-primary">Editar</a>
                            <a href="#" class="btn btn-danger">Cerrar</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/admin/nuevo_llamado') }}" class="btn btn-success">Crear Nuevo Llamado</a>
    </div>
@endsection

