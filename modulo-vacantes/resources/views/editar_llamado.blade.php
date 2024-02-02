@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Editar Llamado</h2>
        <!-- Formulario de Edición -->
        <form action="{{ route('actualizar_llamado', ['id' => $llamado->id]) }}" method="POST">
            @csrf
            @method('PUT') <!-- Indicar que es una solicitud PUT para la edición -->

            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="catedra_id" class="form-label">Cátedra</label>
                <select class="form-select" name="catedra_id" required>
                    <!-- Opciones para seleccionar la cátedra -->
                    @foreach ($catedras as $catedra)
                        <option value="{{ $catedra->id }}" {{ $catedra->id == $llamado->catedra_id ? 'selected' : '' }}>
                            {{ $catedra->nombre }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto</label>
                <input type="text" class="form-control" name="puesto" value="{{ $llamado->puesto }}" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3" required>{{ $llamado->descripcion }}</textarea>
            </div>
            <div class="mb-3 col-md-2">
                <label for="fecha_cierre" class="form-label">Fecha de Cierre</label>
                <input type="date" class="form-control" name="fecha_cierre" value="{{ $llamado->fecha_cierre }}" required>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Actualizar Llamado</button>
        </form>
    </div>
@endsection