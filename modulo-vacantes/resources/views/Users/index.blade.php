@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3">
        <h2 class="m-2 col-11 col-sm-6">Listado de usuarios</h2>
        <a href="{{ route('users.create') }}" class="m-2 col-11 col-sm-3 btn btn-primary">Crear Usuario</a>
    </div>
    <table id="usersTable" class="table  table-striped table-bordered">
        <thead>
            <tr>
                <th scope="col" colspan="2">Nombre</th>
                <th scope="col" colspan="2">Email</th>
                <th scope="col" colspan="2" class="text-center">Acción</th>
            </tr>
        </thead>
        <tbody>
            @foreach($users as $user)
            <tr>
                <td colspan="2">{{$user->name}} {{$user->last_name}}</td>
                <td colspan="2">{{$user->email}}</td>
                <td>
                    <div class='d-flex justify-content-around'>
                        <a href="{{route('users.edit', $user->id)}}" class="btn btn-sm btn-primary ">Editar</a>
                        <form action="{{ route('users.destroy', $user->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class=" btn btn-danger  btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                        </form>    
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>

@section('script')
    <script type="text/javascript">
        alert('a')
        console.log('aa');
        // $(document).ready(function() {
        //     $('#usersTable').DataTable({
        //         pagingType: 'full_numbers',
        //         lengthMenu: [10, 25, 50],
        //         searching: true,
        //     });
        // });
    </script>
@endsection

@endsection
