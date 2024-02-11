<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Llamado;
use App\Models\Postulacion;
use Carbon\Carbon;
use Illuminate\Http\Request;

class PostulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(String $llamadoId)
    {
        try{
            //ModelNotFoundException
            $llamado = Llamado::findOrFail($llamadoId);
            return view("Postulaciones.create_postulacion", compact("llamado"));
        }catch(\Exception $e){
            //VER SI CAMBIO ESTO para SweetAlert
            return redirect()->back()->with("error", $e->getMessage());
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try{
            $request->validate([
                'llamado_id' => 'required|exists:llamados,id',
                'usuario_id' => 'required|exists:users,id',
                'curriculum_vitae' => 'required|mimes:pdf|max:2048',

            ],
            [
                'llamado_id.required' => 'El id del llamado es obligatorio.',
                'llamado_id.exists' => 'El llamado no existe.',
                'usuario_id.required' => 'El id del usuario es obligatorio.',
                'usuario_id.exists' => 'El usuario no existe.',
            ]);

            // Obtener el contenido del archivo
            $cvContent = file_get_contents($request->file('curriculum_vitae')->getRealPath());
            $request->merge([
                'curriculum_vitae' => $cvContent,
            ]);

            $llamado = Llamado::findOrFail($request->llamado_id);
            $hoy = Carbon::now();

            if($hoy > $llamado->fecha_cierre){

            }

            $postulacion = Postulacion::create($request->all());

            //Opcion 1
            $response = response()->json(['data' => $postulacion, 'message' => ['Usted se a postulado exitosamente'], 'status'=> 201, 'success'=>true]);
            return redirect()->route('postulaciones.index')->with('response',$response);

            //Opcion 2
            // return redirect()->route('postulaciones.index')->with('success', 'Usted se a postulado exitosamente');


        }catch(\Exception $e){
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function descargarCurriculum($postulacionId)
    {
        // Obtén la postulación y el usuario asociado
        $postulacion = Postulacion::findOrFail($postulacionId);
        $user = User::findOrFail($postulacion->usuario_id);
        
        // Verifica si el curriculum está almacenado en la base de datos
        if ($postulacion->curriculum_vitae) {
            // Obtén el contenido del PDF desde el BLOB
            $pdfContent = $postulacion->curriculum_vitae;
        
            // Devuelve el archivo como respuesta
            return response($pdfContent, 200)->header('Content-Type', 'application/pdf')
                                              ->header('Content-Disposition', 'attachment; filename=' . $user->name . $user->last_name . '.pdf');
        } else {
            // Maneja la situación en la que el curriculum no existe en la base de datos
            abort(404, 'El curriculum no pudo ser encontrado.');
        }
    }
}
