@extends('layouts.app')
@section('content')

    <div class="container d-flex flex-column align-items-center">
        <h2 class="my-4">{{isset($user) ? 'Editar' : 'Crear'}} Usuario</h2>
        <form class="border shadow p-4 bg-white" method="POST" action="{{ isset($user) ? route('users.update',$user) : route('users.store')  }}">
            @csrf
            @if(isset($user))
                @method('PUT')
            @endif
            <div class="form-group mb-3">
                <label for="name">Nombre </label>
                <input type="text" class="form-control @error('name') is-invalid @enderror" style="width: 300px;" id="name" name="name" required autofocus placeholder="Ingrese el nombre"  autocomplete="name" value={{isset($user) ? $user->name : old('name') }}>
                @error('name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="last_name">Apellido</label>
                <input type="text" class="form-control @error('last_name') is-invalid @enderror" style="width: 300px;" id="last_name" name="last_name" required placeholder="Ingrese el apellido"  autocomplete="last_name" value={{isset($user) ? $user->last_name : old('last_name') }}>
                @error('last_name')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="email">Correo Electrónico</label>
                <input type="email" class="form-control @error('email') is-invalid @enderror" style="width: 300px;" id="email" name="email" required placeholder="Ingrese el email"  autocomplete="email" value={{isset($user) ? $user->email : old('email') }}>
                @error('email')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password">Contraseña</label>
                <input type="password" class="form-control @error('password') is-invalid @enderror" style="width: 300px;" id="password" name="password" required placeholder="Ingrese la contraseña" value={{isset($user) ? $user->password : '' }}>
                @error('password')
                    <span class="invalid-feedback" role="alert">
                        <strong>{{ $message }}</strong>
                    </span>
                @enderror
            </div>
            <div class="form-group mb-3">
                <label for="password-confirm">Confirmar Contraseña</label>
                <input type="password" class="form-control" style="width: 300px;" id="password-confirm" name="password_confirmation" required placeholder="Ingrese la contraseña" value={{isset($user) ? $user->password : '' }}>
            </div>
            <div class="form-group mb-3">
                <label for="rol">Rol</label>
                <select class="form-select" id="rol" name="rol" >
                    @foreach($roles as $rol)
                        <option id="{{$rol->id}}" value="{{$rol->id}}" {{ isset($user) && $user->getRoleNames()[0] == $rol->name ? 'selected' : ' '  }}  >{{$rol->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group mb-3 mt-4 text-center">
                <a href="{{route('users.index')}}" type="submit" class="col-4 btn btn-danger mr-2" style="width: 100px;">Cancelar</a>
                <button type="submit" class="col-4 btn btn-success mr-2" style="width: 100px;">{{isset($user) ? 'Editar' : 'Guardar'}}</button>
            </div>
        </form>
    </div>

<script src="{{ mix('resources/js/shared.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    handleMessage(response);
});
</script>

@endsection
