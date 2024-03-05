@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3">
        <h2 class="m-2 col-11 col-sm-6">Listado de usuarios</h2>
        <a href="{{ route('users.create') }}" class="m-2 col-11 col-sm-3 btn btn-success">Crear Usuario</a>
    </div>
    <div class='table-responsive'>
        <table id="usersTable" class="table  table-striped table-bordered">
            <thead>
                <tr>
                    <th >Nombre</th>
                    <th >Email</th>
                    <th >Rol</th>
                    <th class="text-center">Acción</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td >{{$user->name}} {{$user->last_name}}</td>
                    <td >{{$user->email}}</td>
                    <td >
                        @foreach ($user->getRoleNames() as $role)
                            {{ $role }}
                        @endforeach    
                    </td>
                    <td>
                        <div class='d-flex justify-content-around'>
                            <a href="{{route('users.edit', $user)}}" class="btn btn-sm btn-primary ">Editar</a>
                            <button type="button" class=" btn btn-danger btn-sm" onclick="return aceptar( {{$user->id}} )">Eliminar</button>
                            <form id='eliminar-user-{{$user->id}}' action="{{ route('users.destroy',$user) }}" method="POST" class="d-inline">
                                @method('DELETE')
                                @csrf
                            </form>    
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>


<script src="{{ mix('resources/js/User/index.js') }}" defer></script>
<script src="{{ mix('resources/js/shared.js') }}" defer></script>

<script >        
const response = (@json(session('response')))
document.addEventListener("DOMContentLoaded", ()=> {    
    handleMessage(response);
    cargarDatatable();
});

</script>

@endsection
