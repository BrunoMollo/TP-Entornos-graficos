@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Vacantes de mi catedra</h2>

        @foreach ($llamados as $llamado)
            <div class="card my-2">
                 <div class="card-header">
                    <h5 class="mb-0">
                        <a href="{{ route('postulaciones', ['llamado' => $llamado]) }}">
                            {{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}
                        </a>
                    </h5>
                </div>
            </div>
        @endforeach
    </div>
@endsection
