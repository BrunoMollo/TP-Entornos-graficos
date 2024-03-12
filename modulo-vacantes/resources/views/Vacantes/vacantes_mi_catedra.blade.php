@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Vacantes de mi catedra</h2>
            <hr>
            @if($llamados->isEmpty())
                <div class="text-center">
                    <p class="fs-2 text-danger"><b>No hay llamados en esta cátedra</b></p>
                </div>
            @else
            <div class="table-responsive">
                <table class="table table-responsive table-striped border">
                    <thead>
                        <tr>
                            <th>Cátedra</th>
                            <th>Puesto</th>
                            <th>Descripción</th>
                            <th>Fecha de Cierre</th>
                            <th>Estado</th>
                            <th class='text-center'>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($llamados as $llamado)
                            @php
                                $puntajesPostulaciones=[];
                                foreach($llamado->postulaciones as $postulacion){
                                    array_push( $puntajesPostulaciones,count( $postulacion->meritos()->withPivot('puntaje')->get() ) );
                                };

                                $permitirOrdenMerito = true;
                                foreach($puntajesPostulaciones as $puntajesPostulacion){
                                    if(! $puntajesPostulacion > 0){
                                        $permitirOrdenMerito = false;
                                    };
                                };

                                $abierto = \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') > \Carbon\Carbon::now();

                                $mensaje='';
                                if(!$permitirOrdenMerito && $abierto){
                                    $mensaje='Debe puntuar todas las posutulaciones, además la postulación sigue abierta';
                                }else if(!$permitirOrdenMerito){
                                    $mensaje='Debe puntuar todas las posutulaciones';
                                }else if($abierto){
                                    $mensaje='La postulación sigue abierta';
                                }
                                    
                            @endphp
                            <tr>
                                <td>{{$llamado->catedra ? $llamado->catedra->nombre : 'No tiene catedra'   }}</td>
                                <td>{{$llamado->puesto}}</td>
                                <td>{{$llamado->descripcion}}</td>
                                <td>{{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') }}</td>
                                <td class="{{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') < \Carbon\Carbon::now() ? 'text-danger' : 'text-success' }}">
                                    {{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') < \Carbon\Carbon::now() ? 'Cerrada' : 'Abierta' }}
                                </td>
                                <td class='text-end'>
                                    <div class="text-center ">
                                        <a class="btn btn-sm btn-primary text-center me-3" href="{{ route('postulaciones', ['llamado' => $llamado]) }}">
                                            Ver Postulaciones
                                        </a>
                                        @if($abierto || !$permitirOrdenMerito)
                                            <span class="d-inline-block" tabindex="0" data-bs-toggle="tooltip" title="{{$mensaje}}">
                                        @endif
                                        <a class="btn btn-sm btn-info text-center ms-3 {{ $abierto || !$permitirOrdenMerito ? 'disabled' : '' }}" 
                                            href="{{ route('generar_orden_de_merito',$llamado) }}">
                                            Ver Orden de Merito
                                            @if($abierto || !$permitirOrdenMerito)
                                                <i class="fas fa-info-circle text-danger"></i>
                                            @endif
                                        </a>
                                        @if($abierto || !$permitirOrdenMerito)
                                            </span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>   
    </div>
@endsection

<script src="{{ mix('resources/js/shared.js') }}" defer></script>

<script >        
document.addEventListener("DOMContentLoaded", ()=> {    
    handleTooltip()
});
</script>
