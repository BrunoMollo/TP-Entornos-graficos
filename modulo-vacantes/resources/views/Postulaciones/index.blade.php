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
                    <div class='table-responsive'>
                        <table class="table table-striped border">
                            <thead>
                                <tr>
                                    <th>Postulante</th>
                                    <th>Email</th>
                                    <th>Curriculum</th>
                                    @role('jefe_catedra')
                                        <th class='text-center'>Calificar</th>
                                    @endrole    
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
                                        @role('jefe_catedra')
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
                                        @endrole
                                    </tr>
                                @empty
                                    <tr>
                                        <td class='text-danger text-center fs-2 p-3' colspan="4">No hay postulaciones para este llamado.</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
                @role('jefe_catedra')
                    <div class="col-12">
                        <div class='text-end mt-4'>
                            <button class='btn btn-success {{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') > \Carbon\Carbon::now() ? 'disabled' : ''  }}'>Generar órden de mérito</button>
                        </div>
                    </div>
                @endrole
            </div>
        </div>

    </div>
    
<script src="{{ mix('resources/js/shared.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    handleMessage(response);
});
</script>
@endsection
