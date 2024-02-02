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
                            <a href="{{ route('editar_llamado', ['id' => $llamado->id]) }}" class="btn btn-primary">Editar</a>
                            <button type="button" class="btn btn-danger" onclick="confirmarEliminar({{ $llamado->id }})">Eliminar</button>
                            <form id="form-eliminar-{{ $llamado->id }}" action="{{ route('eliminar_llamado', ['id' => $llamado->id]) }}" method="POST" style="display: none;">
                                @csrf
                                @method('DELETE')
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <a href="{{ url('/admin/nuevo_llamado') }}" class="btn btn-success">Crear Nuevo Llamado</a>
    </div>
@endsection

<!-- Script de JavaScript para la confirmación -->
<script>
    function confirmarEliminar(llamadoId) {
        if (confirm('¿Estás seguro de que deseas eliminar este llamado?')) {
            // Si el usuario confirma, enviar el formulario de eliminación
            document.getElementById('form-eliminar-' + llamadoId).submit();
        }
    }
</script>