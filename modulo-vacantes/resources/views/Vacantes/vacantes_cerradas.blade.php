@extends('layouts.app')
@section('content')
    <div class="container">
        <h2 class="my-4">Listado de llamados cerrados</h2>
        @if($llamados->isEmpty())
            <div class="text-center">
                <p class="fs-2 text-danger"><b>No hay llamados abiertos</b></p>
            </div>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>Cátedra</th>
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
                            <td>{{ \Carbon\Carbon::parse($llamado->fecha_cierre)->format('Y-m-d') }}</td>
                            <td>
                                <button class='btn btn-primary btn-sm'>Ver órden de mérito</button>
                            </TD>
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
