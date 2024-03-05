@extends('layouts.app')
@section('content')
    <div class="container">
        <div class='shadow px-1  px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Listado de llamados cerrados</h2>
            <hr>
                @if($llamados->isEmpty())
                    <div class="text-center">
                        <p class="fs-2 text-danger"><b>No hay llamados abiertos</b></p>
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
                                    <td class='text-end'>
                                        <button class='btn btn-primary btn-sm '>Ver órden de mérito</button>
                                    </TD>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif
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
