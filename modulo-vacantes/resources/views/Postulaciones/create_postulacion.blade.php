@extends('layouts.app')
@section('content')
    @auth
        @php
            $postulacion = $llamado->postulaciones()->where('usuario_id', Auth::id())->first();
        @endphp
    @endauth
    <div class="container">
        <div class='shadow px-3 px-sm-5 pt-4 pb-3 bg-white'>
            <div class="col-sm-6 col-12 mx-auto text-center">
                <h2 class='fw-bold'>Postulacion a vacante</h2>
                <hr>
            </div>
            <div class="col-sm col-12">
                <h6><b>Catedra:</b> {{ $llamado->catedra->nombre }}</h6>
                <h6><b>Puesto:</b> {{ $llamado->puesto }}</h6>
                <h6><b>Fecha cierre de postulacion:</b>  {{ \Carbon\Carbon::parse($llamado->fecha_cierre) }}</h6>
            </div>
            <form action="{{ route('postulaciones.store') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="llamado_id" value="{{ $llamado->id }}">
                @auth
                    <input type="hidden" name="usuario_id" value="{{ Auth::user()->id }}">
                @endauth
                @if($postulacion) 
                    <div class='text-center'>
                        <h3 class="text-danger  fs-2 mt-5">Ya se ha postulado a este llamado!</h3>
                        <a href='{{ route('index') }}' class='btn btn-outline-primary my-3 mx-2'>Volver</a>
                        <form action="{{route('postulaciones.destroy',$postulacion)}}" method='POST'>
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Cancelar Postulacion</a>
                        </form>
                    </div>
                @else
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
                @endif
            </form>
        </div>
    </div>

    <script>
        const response = (@json(session('response')))
        console.log(response)
        if(response){
            const successMessage = Array.isArray(response.original.message) ?  response.original.message.join('<br>') : response.original.message
            if(response.original.success){
                Swal.fire('',successMessage,'success').then((res)=>{
                    if(res){
                        //console.log('a')
                        window.location.href='/'
                    }
                })
            }else{
                Swal.fire('Error',successMessage,'error')
            }
        }
    </script>
@endsection
