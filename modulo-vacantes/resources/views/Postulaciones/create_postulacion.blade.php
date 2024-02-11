@extends('layouts.app')
@section('content')
    <div class="container">
        <div class="col-sm-6 col-12 mx-auto text-center">
            <h2>Postulacion a vacante</h2>
        </div>
        <div class="col-sm col-12">
            <h6>Catedra: {{ $llamado->catedra->nombre }}</h6>
            <h6>Puesto: {{ $llamado->puesto }}</h6>
            <h6>Fecha cierre de postulacion: {{ \Carbon\Carbon::parse($llamado->fecha_cierre) }}</h6>
        </div>
        <form action="{{ route('postulaciones.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="llamado_id" value="{{ $llamado->id }}">
            @auth
                <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
            @endauth
            <div class="row justify-content-center text-center">
                <label class="fs-3" for="curriculum_vitae">Seleccionar CV</label>
                <div class="m-2 p-3 col-12 col-sm-6 text-center border border-primary border-3">
                    <input type="file" class="form-control-file form-control-sm" id="curriculum_vitae" name="curriculum_vitae">
                </div>
                <div class="m-2 col-12 col-sm-6 text-center">
                    <a href='{{ route('index') }}' class="btn btn-danger">Cancelar</a>
                    <button type="submit" class="btn btn-success">Presentar</button>
                </div>
            </div>
        </form>
    </div>
@endsection
