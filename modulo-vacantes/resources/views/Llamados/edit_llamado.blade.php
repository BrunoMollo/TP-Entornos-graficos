@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>

            <h2 class="my-4 text-center fw-bold">Editar Llamado</h2>
            <!-- Formulario de Edición -->
            <form action="{{ route('actualizar_llamado', ['id' => $llamado->id]) }}" method="POST">
                @csrf
                @method('PUT') 
    
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
                    @php
                        $fecha = explode(" ", $llamado->fecha_cierre)[0]
                    @endphp
                    <input type="date" class="form-control" name="fecha_cierre" value="{{$fecha}}" required>
                </div>
                <!-- Botón para enviar el formulario -->
                <div class="text-end my-3">
                    <button type="submit" class="btn btn-success">Actualizar Llamado</button>
                </div>
            </form>
        </div>

    </div>

<script src="{{ mix('resources/js/Llamado/index.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    editLlamadoMessage(response);
});
</script>
@endsection