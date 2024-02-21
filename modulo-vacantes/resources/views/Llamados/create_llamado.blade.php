@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Crear Nuevo Llamado</h2>
            <hr>
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
                <div class='text-end my-3'>
                    <button type="submit" class="btn btn-success">Crear Llamado</button>
                </div>
            </form>
        </div>
    </div>

<script>
    const response = (@json(session('response')))
    console.log(response)
    if(response){
        const successMessage = Array.isArray(response.original.message) ?  response.original.message.join('<br>') : response.original.message
        if(response.original.success){
            Swal.fire('',successMessage,'success').then((res)=>{
                if(res){
                    window.location.href='administrar_llamados'
                }
            })
        }else{
            Swal.fire('Error',successMessage,'error')
        }
    };
</script>
@endsection
