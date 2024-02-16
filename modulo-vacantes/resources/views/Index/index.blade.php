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
                                @php
                                    $postulacion = $llamado->postulaciones()->where('usuario_id', Auth::id())->first();
                                @endphp
                                @if( $postulacion )
                                    <td>
                                        <form action="{{route('postulaciones.destroy',$postulacion)}}" method='POST'>
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger">Cancelar</a>
                                        </form>
                                    </td>
                                @else
                                    <td>
                                        <a href=" {{route('postulaciones.crear',['llamadoId' => $llamado->id])}} " type="button" class="btn btn-primary">Postularme</a>
                                    </td>
                                @endif
                                @endrole
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>

    <script>
        const response = (@json(session('response')))
        console.log(response)
        if(response){
            const successMessage = response.original.message.join('<br>')
            if(response.original.success){
                Swal.fire('',successMessage,'success')
            }else{
                Swal.fire('Error',successMessage,'error')

            }
        }
    </script>
@endsection
