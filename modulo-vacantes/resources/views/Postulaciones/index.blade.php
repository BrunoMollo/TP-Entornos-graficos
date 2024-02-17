@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Postulaciones para el llamado "{{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}"</h2>
        <table class="table">
            <thead>
                <tr>
                    <th>Postulante</th>
                    <th>Email</th>
                    <th>Curriculum</th>
                    <th>Calificar</th>
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
                                <a href='{{ route('calificar_postulacion',$postulacion->id) }}' class="btn btn-primary">
                                    @if( $postulacion->meritos()->withPivot('puntaje')->get() )
                                        Editar
                                    @else
                                        Calificar
                                    @endif
                                </a>
                                @if( $postulacion->meritos()->withPivot('puntaje')->get() )
                                    <i class='fa fa-check text-success ms-2 fs-3'></i>
                                @endif
                            </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay postulaciones para este llamado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

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
