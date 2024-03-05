@extends('layouts.app')

@section('content')
    <div class="container">
        <div class='shadow px-1 px-sm-5 pt-1 pb-3 bg-white'>
            <h2 class="my-4 text-center fw-bold">Vacantes de mi catedra</h2>
            <hr>
            @if($llamados->isEmpty())
                <div class="text-center">
                    <p class="fs-2 fw-bold text-danger"><b>No hay llamados en esta cátedra</b></p>
                </div>
            @else
                @foreach ($llamados as $llamado)
                    <div class="card my-2">
                        <div class="card-header">
                            <h5 class="mb-0">
                                <a class="text-decoration-none" href="{{ route('postulaciones', ['llamado' => $llamado]) }}">
                                    {{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}
                                </a>
                            </h5>
                        </div>
                    </div>
                @endforeach
            @endif
        </div>   
    </div>
@endsection
