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
        return view('Llamados.index', ['llamados' => $llamados]);
    }

    public function create()
    {
        $catedras = Catedra::all();

        return view('Llamados.create_llamado', ['catedras' => $catedras]);
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

        if($request->fecha_cierre < Carbon::now()){
            // MANEJAR ERROR
        }
    
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
        $llamado = Llamado::findOrFail($id);
        $catedras = Catedra::all();

        return view('Llamados.edit_llamado', compact('llamado', 'catedras'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'catedra_id' => 'required|exists:catedras,id',
            'puesto' => 'required|string|max:255',
            'descripcion' => 'required|string',
            'fecha_cierre' => 'required|date',
        ]);

        $llamado = Llamado::findOrFail($id);

        if($request->fecha_cierre < Carbon::now()){
            // MANEJAR ERROR
        }

        $llamado->update([
            'catedra_id' => $request->input('catedra_id'),
            'puesto' => $request->input('puesto'),
            'descripcion' => $request->input('descripcion'),
            'fecha_cierre' => $request->input('fecha_cierre'),
        ]);

        return redirect()->route('admin_llamados')->with('success', 'Llamado actualizado exitosamente');
    }

    public function destroy($id)
    {
        $llamado = Llamado::findOrFail($id);
        $llamado->delete();

        return redirect()->route('admin_llamados')->with('success', 'Llamado eliminado exitosamente');
    }
}
