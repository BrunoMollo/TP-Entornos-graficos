@extends('layouts.app')
@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Últimas vacantes abiertas</h2>
            <hr>
            @if($llamados->isEmpty())
                <div class="text-center">
                    <p class="fs-2 fw-bold text-danger"><b>No hay llamados abiertos</b></p>
                </div>
            @else
            <div class='table-responsive'>
                <table class="table table-striped border">
                    <thead>
                        <tr>
                            <th>Cátera</th>
                            <th>Puesto</th>
                            <th>Descripción</th>
                            <th>Fecha de Cierre</th>
                            @auth
                                @role('postulante')
                                    <th></th>
                                @endrole
                            @endauth
                        </tr>
                    </thead>
                    <tbody>
                            
                        @foreach($llamados as $llamado)
                            <tr>
                                <td>{{$llamado->catedra ? $llamado->catedra->nombre : 'No tiene catedra'   }}</td>
                                <td>{{$llamado->puesto}}</td>
                                <td>{{$llamado->descripcion}}</td>
                                <td>{{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') }}
                                    <a href="{{route('test',['dest'=>'ginogallina2002@gmail.com','llamado'=> $llamado])}}">Mail</a>
                                </td>
                                @auth
                                    @role('postulante')
                                    @php
                                        $postulacion = $llamado->postulaciones()->where('usuario_id', Auth::id())->first();
                                    @endphp
                                    @if( $postulacion )
                                        <td class='text-end'>
                                            <button type="button" class="btn btn-danger btn-sm" onclick="aceptar( {{$postulacion->id}} )">Cancelar</a>
                                            <form id='cancelar-postulacion-{{$postulacion->id}}' action="{{route('postulaciones.destroy',$postulacion)}}" method='POST'>
                                                @csrf
                                                @method('DELETE')
                                            </form>
                                        </td>
                                    @else
                                        <td class='text-end'>
                                            <a href=" {{route('postulaciones.crear',['llamadoId' => $llamado->id])}} " type="button" class="btn btn-primary btn-sm">Postularme</a>
                                        </td>
                                    @endif
                                    @endrole
                                @endauth
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            @endif
        </div>
    </div>

<script src="{{ mix('resources/js/shared.js') }}" defer></script>
<script src="{{ mix('resources/js/Index/index.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    handleMessage(response);
});
</script>
@endsection


