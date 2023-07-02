<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="m-2 col-12 col-sm-6 text-center">Listado de postulaciones</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th class="text-center" colspan="2">Postulante</th>
                    <th class="text-center">Email</th>
                    <th class="text-center">Opción</th>
                </tr>
            </thead>
            <tbody>
                @foreach([['Bruno Mollo','bmollo@gmail.com'],['Facundo Braida','fbraida@gmail.com'],['Gino Gallina','ggallina@gmail.com'], ['Kevin Masci','kmasci@gmail.com'], ['Jose Perez','jperez@gmail.com']] as $postulante)
                <tr>
                    <td class="text-start" colspan="2">{{$postulante[0]}}</td>
                    <td class="text-center"> {{$postulante[1]}}</td>
                    <td class="text-center"> <button class="btn btn-primary">Calificar</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row d-flex ">
            <button class="col-2 btn btn-primary ms-auto">Generar Orden de Merito</button>
        </div>

    </div>

</x-layout>