@extends('layouts.app')
@section('content')
@php 
    $puntajesPostulaciones=[];
    foreach($postulaciones as $postulacion){
        array_push( $puntajesPostulaciones,count( $postulacion->meritos()->withPivot('puntaje')->get() ) );
    };

    $permitirOrdenMerito = true;
    foreach($puntajesPostulaciones as $puntajesPostulacion){
        if(! $puntajesPostulacion > 0){
            $permitirOrdenMerito = false;
        };
    };

@endphp
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <div class="row justify-content-center w-100 p-3">
                <h2 class="m-2 col-12 col-sm-6 w-100 text-center">Resultados de Orden de Merito a vacante de <b>{{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}</b></h2>
            </div>
            <div class='table-responsive'>
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th>Puesto</th>
                            <th>Postulantes</th>
                            @foreach($meritos as $merito)
                                <th class="text-center">{{$merito->nombre}}</th>
                            @endforeach
                            <th>Total</th>
                            @auth
                                @role('jefe_catedra')
                                    <th>Acción</th>
                                @endrole
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                        @if(!$permitirOrdenMerito)
                            <tr >
                                <td class='text-danger text-center fs-4' colspan='{{count($meritos)+4}}'>
                                    Debe cargar todos los puntajes de las postulaciones primero!
                                </td>
                            </tr>
                        @else
                            @foreach($postulaciones as $index => $postulacion)
                                <tr>
                                    <td class="text-center">{{$index + 1}} º</td>
                                    <td class="text-center" >{{$postulacion->user->name}} {{$postulacion->user->last_name}}</td>
                                    @foreach($postulacion->meritos()->withPivot('puntaje')->get() as $meritoConPuntaje)
                                        <td class="text-center">{{$meritoConPuntaje->pivot->puntaje;}}</td>
                                    @endforeach
                                    <td>
                                        {{$postulacion->total}}
                                    </td>
                                    @auth
                                        @role('jefe_catedra')
                                            <td class='text-center'>
                                                @if($index < 2)
                                                    <button id="btn-open-modal-{{$index}}" class='btn btn-sm btn-info' type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#miModal" data-email="{{$postulacion->user->email}}" data-posicion='1' data-llamado="{{$llamado->id}}" data-dest="{{ route('primer_puesto',['dest'=> $postulacion->user->email,'llamado'=> $llamado->id]) }}">
                                                        Enviar mail
                                                    </button>
                                                    <!-- <a target='_blank' class='btn btn-sm btn-danger' href="mailto:{{$postulacion->user->email}}?subject=Primer/SegundoPuesto&">Enviar correo electrónico</a> -->
                                                @endif
                                            </td>
                                        @endrole
                                    @endauth
                                </tr>
                            @endforeach
                        @endif
                    </tbody>
                </table>
            </div>
            <div class="row d-flex justify-content-center mt-3">
                <a href="{{ route('postulaciones',$llamado) }}" class=" col-4 btn btn-primary">Volver</a>
            </div>
        </div>
    </div>


    <!-- MODAL -->

    <div class="modal fade" id="miModal" tabindex="-1" aria-labelledby="miModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="miModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                    <form action="" method='POST'>
                        @csrf
                        <div class="mb-3">
                            <label for="contenido" class="form-label">Mensaje:</label>
                            <textarea class="form-control" id="contenido" name='contenido' rows="5"></textarea>
                        </div>
                        <div class='text-center'>
                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-success ms-2" >Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection

<script src="{{ mix('resources/js/shared.js') }}" defer></script>
<script src="{{ mix('resources/js/Postulacion/index.js') }}" defer></script>


<script>
    const response = (@json(session('response')))

    document.addEventListener("DOMContentLoaded", ()=> {
        
        handleMessage(response);
        emailHandler();

    });
</script>