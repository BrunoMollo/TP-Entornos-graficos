@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="my-4">Ultimas vacantes abiertas</h2>
        @if($llamados->isEmpty())
            <div class="text-center">
                <p class="fs-2 text-danger"><b>No hay llamados abiertos</b></p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Llamada</th>
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
                            <td>{{$llamado->catedra ? $llamado->catedra->nombre : 'No tiene catedra'   }} - {{$llamado->puesto}} - {{$llamado->descripcion}}</td>
                            <td>{{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') }}
        <a href="{{route('test',['dest'=>'ginogallina2002@gmail.com','llamado'=> $llamado])}}">Mail</a>
                        </td>

                            @auth
                                @role('postulante')
                            <td>
                                <a href=" {{route('postulaciones.crear',['llamadoId' => $llamado->id])}} " type="button" class="btn btn-primary">Postularme</a>
                            </td>
                                @endrole
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
