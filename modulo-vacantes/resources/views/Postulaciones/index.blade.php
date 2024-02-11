@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="my-4">Postulaciones para el llamado "{{ $llamado->catedra->nombre }} - {{ $llamado->puesto }}"</h2>

        <table class="table">
            <thead>
                <tr>
                    <th>Postulante</th>
                    <th>Email</th>
                    <th>Curriculum</th>
                    <th>Calificar</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($postulaciones as $postulacion)
                    <tr>
                        <td>{{ $postulacion->user->name }} {{ $postulacion->user->last_name }}</td>
                        <td>{{ $postulacion->user->email }}</td>
                        <td>
                            <a href="{{ route('descargar_curriculum', ['postulacionId' => $postulacion->id]) }}" class="btn btn-link">Descargar Curriculum</a>
                        </td>
                        <td>
                            <button class="btn btn-primary">Calificar</button>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No hay postulaciones para este llamado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
@endsection
