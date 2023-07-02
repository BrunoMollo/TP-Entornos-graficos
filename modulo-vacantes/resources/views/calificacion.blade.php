<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <div class="m-2 col-12 col-sm-6 text-center">
                <h2 class="fw-bolder">Catedra Teoria de contol</h2>
                <h4>Puesto : Profesor auxiliar</h4>
            </div>
        </div>
        <div class="row">
            <div class="ms-2 col-6 col-sm-6 ">
                <h6 class="fw-bolder">Postulante: Cristian Rodriguez</h6>
                <h6 class="fw-bolder">Link CV: https://bisbal.com.ar</h6>
            </div>
        </div>
        <div class="table-responsive">
            <table class="mt-3 table text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope=" col" colspan="4">Merito</th>
                        <th scope="col" class="text-center">Puntaje</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach([['Titulo universitario',9],['Antecedentes docentes',12],['Cursos de especializacion',15], ['Concurrencia a congresos',1], ['Antecedentes laborales',10]] as $merito)
                    <tr>
                        <td class="text-start" colspan="4">{{$merito[0]}}</td>
                        <td><input value="{{$merito[1]}}"></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row d-flex justify-content-center">
            <button class="me-1 col-3 btn btn-primary">Volver</button>
            <button class="ms-1 col-3 btn btn-success">Guardar</button>
        </div>
    </div>
</x-layout>