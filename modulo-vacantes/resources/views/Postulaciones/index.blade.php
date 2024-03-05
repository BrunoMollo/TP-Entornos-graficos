@extends('layouts.app')

@section('content')
    <div class="container h-100">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <div class="row align-items-center">
                <div class="col-12">
                    <h2 class="my-4 text-center fw-bold">Postulaciones para el llamado "{{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}"</h2>
                    <hr>
                </div>
                <div class="col-12">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Postulante</th>
                                <th>Email</th>
                                <th>Curriculum</th>
                                <th class='text-center'>Calificar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($postulaciones as $postulacion)
                                <tr>
                                    <td>{{ $postulacion->user->name }} {{ $postulacion->user->last_name }}</td>
                                    <td>{{ $postulacion->user->email }}</td>
                                    <td>
                                        <a href="{{ route('descargar_curriculum', ['postulacionId' => $postulacion->id]) }}" class="btn btn-link">Descargar Curriculum</a>
                                    </td>
                                        <td>
                                            <div class='d-flex justify-content-around'>
                                                <a href='{{ route('calificar_postulacion',$postulacion->id) }}' class="btn btn-primary">
                                                    @if( count($postulacion->meritos()->withPivot('puntaje')->get()) > 0 )
                                                        Editar
                                                    @else
                                                        Calificar
                                                    @endif
                                                </a>
                                                @if( count($postulacion->meritos()->withPivot('puntaje')->get()) > 0)
                                                    <i class='fa fa-check text-success ms-2 fs-3'></i>
                                                @endif
                                            </div>
                                        </td>
                                </tr>
                            @empty
                                <tr>
                                    <td class='text-danger text-center fs-2 p-3' colspan="4">No hay postulaciones para este llamado.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="col-12">
                    <div class='text-end mt-4'>
                        <button class='btn btn-success {{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') > \Carbon\Carbon::now() ? 'disabled' : ''  }}'>Generar órden de mérito</button>
                    </div>
                </div>
            </div>
        </div>

    </div>

<script>
    const response = (@json(session('response')))
    console.log(response)
    if(response){
        const successMessage = Array.isArray(response.original.message) ?  response.original.message.join('<br>') : response.original.message
        if(response.original.success){
            Swal.fire('',successMessage,'success')
        }else{
            Swal.fire('Error',successMessage,'error')
        }
    };
</script>
@endsection
