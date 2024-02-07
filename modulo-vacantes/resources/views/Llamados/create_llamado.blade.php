@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Crear Nuevo Llamado</h2>
        <!-- Formulario de Creación -->
        <form action="{{ route('guardar_llamado') }}" method="POST">
            @csrf
            <!-- Campos del formulario -->
            <div class="mb-3">
                <label for="catedra_id" class="form-label">Cátedra</label>
                <select class="form-select" name="catedra_id" required>
                    <!-- Opciones para seleccionar la cátedra -->
                    @foreach ($catedras as $catedra)
                        <option value="{{ $catedra->id }}">{{ $catedra->nombre }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="puesto" class="form-label">Puesto</label>
                <input type="text" class="form-control" name="puesto" required>
            </div>
            <div class="mb-3">
                <label for="descripcion" class="form-label">Descripción</label>
                <textarea class="form-control" name="descripcion" rows="3" required></textarea>
            </div>
            <div class="mb-3 col-md-2">
                <label for="fecha_cierre" class="form-label">Fecha de Cierre</label>
                <input type="date" class="form-control" min="{{ date('Y-m-d') }}" name="fecha_cierre" required>
            </div>
            <!-- Botón para enviar el formulario -->
            <button type="submit" class="btn btn-primary">Crear Llamado</button>
        </form>
    </div>
@endsection
