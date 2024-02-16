@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-between mb-3">
        <h2 class="m-2 col-11 col-sm-6">Listado de usuarios</h2>
        <a href="{{ route('users.create') }}" class="m-2 col-11 col-sm-3 btn btn-success">Crear Usuario</a>
    </div>
    <table id="usersTable" class="table responsive table-striped table-bordered">
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
                        <form action="{{ route('users.destroy',$user) }}" method="POST" class="d-inline">
                            @method('DELETE')
                            @csrf
                            <button type="submit" class=" btn btn-danger  btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este usuario?')">Eliminar</button>
                        </form>    
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

</div>


<script >
    $(document).ready(function() {
        $('#usersTable').DataTable({
            pagingType: 'full_numbers',
            lengthMenu: [10, 25, 50],
            searching: true,
            "language": {
                "search": "Buscar:",
                "lengthMenu": "Mostrar _MENU_ usuarios por página",
                "zeroRecords": "No se encontraron usuarios",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ usuarios",
                "infoEmpty": "Mostrando 0 a 0 de 0 usuarios",
                "infoFiltered": "(filtrado de _MAX_ usuarios totales)",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            }
        });
    });


        
    const response = (@json(session('response')))
    console.log(response)
    if(response){
        const successMessage = response.original.message.join('<br>')
        if(response.original.success){
            Swal.fire('',successMessage,'success')
        }else{
            Swal.fire('Error',successMessage,'error')

        }
    };

</script>

@endsection
