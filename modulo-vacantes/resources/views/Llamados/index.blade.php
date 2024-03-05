@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Administración de Llamados</h2>
            <hr>
            <div class='table-responsive'> 
                <table class="table table-striped border">
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
                                <td class='text-center'>
                                    <a href="{{ route('postulaciones', ['llamado' => $llamado]) }}" class="btn btn-warning mb-2 mb-lg-0">Ver postulaciones</a>
                                    <a href="{{ route('editar_llamado', ['id' => $llamado->id]) }}" class="btn btn-primary mb-2 mb-lg-0">Editar</a>
                                    <button type="button" class="btn btn-danger" onclick="aceptar({{ $llamado->id }})">Eliminar</button>
                                    <form id="form-eliminar-{{ $llamado->id }}" action="{{ route('eliminar_llamado', ['id' => $llamado->id]) }}" method="POST" style="display: none;">
                                        @csrf
                                        @method('DELETE')
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class='text-end my-2'>
                <a href="{{ url('/admin/nuevo_llamado') }}" class="btn btn-success">Crear Nuevo Llamado</a>
            </div>
        </div>
        <form id="form-eliminar-postulaciones-{{ $llamado->id }}" action="{{ route('eliminar_llamado_con_postulaciones', ['id' => $llamado->id]) }}" method="POST" style="display: none;">
            @csrf
            @method('DELETE')
        </form>
    </div>
    
<!-- Script de JavaScript para la confirmación -->
<script src="{{ mix('resources/js/Llamado/index.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    indexLlamadoMessage(response);
});
</script>
@endsection
