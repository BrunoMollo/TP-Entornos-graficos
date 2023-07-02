<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="m-2 col-12 col-sm-6 text-center">Resultados de Orden de Merito a vacante de <b>Teoria de contol</b></h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center" colspan="2">Postulantes</th>
                    <th scope="col" class="text-center">Titulo universitario</th>
                    <th scope="col" class="text-center">Titulo vinculado a la asignatura</th>
                    <th scope="col" class="text-center">Antecedentes docentes</th>
                    <th scope="col" class="text-center">Antecedentes laborales afines a la asignatura</th>
                    <th scope="col" class="text-center">Obras y publicaciones</th>
                    <th scope="col" class="text-center">Concurrencia a congresos</th>
                    <th scope="col" class="text-center">Total</th>
                </tr>
            </thead>
            <tbody>
                @foreach([['Bruno Mollo',9,5,2,5,0,0,21],['Facundo Braida',9,5,2,5,0,0,21],['Gino Gallina',9,5,2,5,0,0,21], ['Kevin Masci',9,5,2,5,0,0,21], ['Jose Perez',9,5,2,5,0,0,21]] as $user)
                <tr>
                    <td class="text-start" colspan="2">{{$user[0]}}</td>
                    <td class="text-center">{{$user[1]}}</td>
                    <td class="text-center">{{$user[2]}}</td>
                    <td class="text-center">{{$user[3]}}</td>
                    <td class="text-center">{{$user[4]}}</td>
                    <td class="text-center">{{$user[5]}}</td>
                    <td class="text-center">{{$user[6]}}</td>
                    <td class="text-center">{{$user[7]}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
        <div class="row d-flex justify-content-center">
            <button class=" col-4 btn btn-primary">Volver</button>
        </div>
    </div>
</x-layout>
