@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Vacantes de mi catedra</h2>

        @foreach ($llamados as $llamado)
            <div class="card my-2">
                <div class="card-header">
                    <h5 class="mb-0">
                        {{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}
                        <button class="btn btn-link float-right" data-toggle="collapse" data-target="#postulaciones{{ $llamado->id }}" aria-expanded="true">
                            Ver Postulaciones
                        </button>
                    </h5>
                </div>

                <div id="postulaciones{{ $llamado->id }}" class="collapse">
                    <div class="card-body">
                        <!-- Verifica si hay postulaciones antes de intentar iterar sobre ellas -->
                        @forelse ($llamado->postulaciones ?? [] as $postulacion)
                            <!-- Mostrar información de la postulación -->
                        @empty
                            <p>No hay postulaciones para este llamado.</p>
                        @endforelse
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
