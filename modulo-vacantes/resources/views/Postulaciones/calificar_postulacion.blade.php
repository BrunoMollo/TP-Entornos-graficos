@extends('layouts.app')
@section('content')
@php
    $meritosConPuntajes = $postulacion->meritos()->withPivot('puntaje')->get();
    $total = 0;
    foreach($meritosConPuntajes as $merito){
        $total+=$merito->pivot->puntaje;
    }
@endphp
    <div class="container">
        <div class="row justify-content-center">
            <div class="m-2 col-12 col-sm-6 text-center">
                <h2 class="fw-bolder">Catedra {{$postulacion->llamado->catedra->nombre}}</h2>
                <h4>Puesto : {{$postulacion->llamado->puesto}}</h4>
            </div>
        </div>
        <div class="row">
            <div class="ms-2 col-6 col-sm-6 ">
                <h6 class="fw-bolder">Postulante: {{$postulacion->user->name}} {{$postulacion->user->last_name}}</h6>
                <h6 class="fw-bolder">Link CV: <a class='text-decoration-none' href="{{ route('descargar_curriculum', ['postulacionId' => $postulacion->id]) }}">Descargar</a></h6>
            </div>
        </div>
        <div class="table-responsive">
            <table class="mt-3 table text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope=" col" colspan="4">Merito</th>
                        <th scope="col" class="text-center">Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    <form action='{{ route('asignar_puntajes', ['postulacion' => $postulacion->id])}}' method='POST'>
                        @csrf
                        @foreach($meritos as $merito)
                        <tr>
                            <td class="text-start" colspan="4">{{$merito->nombre}}</td>
                            <td>
                                <input required value='{{ count($meritosConPuntajes) > 0 ? $meritosConPuntajes->where('id',$merito->id)->first()->pivot->puntaje  : '' }}' type='number' min='0' max='10' id="merito_{{ $merito->id }}" name="meritos[{{ $merito->id }}]">
                            </td>
                        </tr>
                        @endforeach
                        <tr class='text-center' >
                            <td colspan='2' class='fs-4'><b>Total: {{$total}}</b></td>
                        </tr>   
                    </tbody>
                </table>
                
            </div>
            <div class="row d-flex justify-content-center">
                <a href='{{url()->previous()}}' class="me-1 col-3 btn btn-primary">Volver</a>
                <button type='submit' class="ms-1 col-3 btn btn-success">Guardar</button>
            </div>
                    </form>
    </div>
    
<script src="{{ mix('resources/js/Postulacion/index.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    calificarPostulacionMessage(response);
});
</script>

@endsection
