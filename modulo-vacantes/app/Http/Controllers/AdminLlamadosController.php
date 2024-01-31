<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llamado;
use App\Models\Catedra;
use Carbon\Carbon;

class AdminLlamadosController extends Controller
{
        public function admin_llamados()
    {
        $llamados = Llamado::with('catedra')->get();
        return view('admin.administrar_llamados', ['llamados' => $llamados]);
    }

    public function create()
    {
        $catedras = Catedra::all();

        return view('admin.nuevo_llamado', ['catedras' => $catedras]);
    }

    public function store(Request $request)
    {
        // Validación de los campos del formulario
        $request->validate([
            'catedra_id' => 'required|exists:catedras,id',
            'puesto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_cierre' => 'required|date',
        ]);
    
        // Crear un nuevo llamado en la base de datos
        Llamado::create([
            'catedra_id' => $request->input('catedra_id'),
            'puesto' => $request->input('puesto'),
            'descripcion' => $request->input('descripcion'),
            'fecha_apertura' => Carbon::now(),
            'fecha_cierre' => $request->input('fecha_cierre'),
        ]);
    
        // Redireccionar
        return redirect()->route('admin_llamados')->with('success', 'Llamado creado exitosamente');
    }

    public function edit($id)
    {
        // Lógica para mostrar el formulario de edición de llamados
    }

    public function update(Request $request, $id)
    {
        // Lógica para actualizar un llamado existente en la base de datos
    }

    public function destroy($id)
    {
        // Lógica para eliminar un llamado de la base de datos
    }
}
