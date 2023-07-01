<x-layout>
    <div class="container">
        <div class="row justify-content-center">
            <h2 class="m-2 col-12 col-sm-6 text-center">Listado de vacantes abiertas</h2>
        </div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center" colspan="2">Vacante</th>
                    <th scope="col" class="text-center">Opción</th>
                </tr>
            </thead>
            <tbody>
                @foreach(['Teoria de Control','Fisica 2', 'Sistemas de Representación', 'Simulación', 'Ingeniera de Software'] as $subject)
                <tr>
                    <td class="text-start" colspan="2">{{$subject}}</td>
                    <td class="text-center"> <button class="btn btn-primary">Inscribirme</button></td>
                </tr>
                @endforeach
            </tbody>
        </table>

    </div>

    </html>
</x-layout>
