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
<script>
    // function confirmarEliminar(llamadoId) {
    //     if (confirm('¿Estás seguro de que deseas eliminar este llamado?')) {
    //         // Si el usuario confirma, enviar el formulario de eliminación
    //         document.getElementById('form-eliminar-' + llamadoId).submit();
    //     }
    // }

    const aceptar = (id)=>{
        Swal.fire({
            title: '¿Estás seguro?',
            text: "¡No podrás revertir esto!",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#d33',
            cancelButtonColor: '#3085d6',
            confirmButtonText: 'Sí, eliminarlo',
            cancelButtonText: 'Cancelar',
            cancelButtonColor: '#6c757d', 
            reverseButtons: true
        }).then((res)=>{
            if(res.isConfirmed){
                document.getElementById(`form-eliminar-${id}`).submit();
        }})
    }

    const response = (@json(session('response')))
    console.log(response)
    if(response){
        const successMessage = Array.isArray(response.original.message) ?  response.original.message.join('<br>') : response.original.message
        if(response.original.success){
            Swal.fire('',successMessage,'success')
        }else{
            Swal.fire('Error',successMessage,'error').then((res)=>{
                if(res && response.original.id){
                    Swal.fire({
                        title: '¿Estás seguro?',
                        text: 'Se eliminarán todas las postulaciones asociadas a este llamado.',
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#d33',
                        cancelButtonColor: '#6c757d',
                        confirmButtonText: 'Sí, eliminar',
                        cancelButtonText: 'Cancelar',
                        cancelButtonColor: '#6c757d', 
                        reverseButtons: true
                    }).then((result) => {
                        if (result.isConfirmed) {
                            console.log('a')
                            document.getElementById(`form-eliminar-postulaciones-${response.original.id}`).submit();
                        }
                    });
                }
            })
        }
    };

</script>
@endsection
