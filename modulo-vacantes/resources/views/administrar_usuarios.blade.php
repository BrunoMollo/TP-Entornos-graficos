<x-layout>
    <div class="container">
        <div class="row">
            <h2 class="m-2 col-11 col-sm-6">Listado de usuarios</h2>
            <button class="m-2 col-11 col-sm-3 btn btn-primary">Crear Usuario</button>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" colspan="2">Usuario</th>
                    <th scope="col">Editar</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['Bruno Mollo','Facundo Braida', 'Gino Gallina', 'Kevin Masci', 'Julian Gabriel Butti'] as $user)
                <tr>
                    <td colspan="2">{{$user}}</td>
                    <td> <button class="btn btn-primary">Editar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    </html>
</x-layout>
