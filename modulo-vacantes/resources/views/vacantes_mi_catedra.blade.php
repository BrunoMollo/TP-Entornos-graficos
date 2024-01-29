@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="m-2 col-12 col-sm-6 text-center">Listado de vacantes de la cátedra <b>Teoria de Control</b></h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center"  colspan="2" >Postulante</th>
                    <th  class="text-center">Opción</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['Bruno Mollo','Facundo Braida', 'Gino Gallina', 'Kevin Masci', 'Jose Perez'] as $postulante)
                <tr>
                    <td class="text-start" colspan="2">{{$postulante}}</td>
                    <td class="d-flex justify-content-around">
                      <button class="btn btn-primary">Ver Postulación</button>
                      <button class="btn btn-primary">Cargar Órden de Mérito</button>
                    </td>

                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    </html>
@endsection
