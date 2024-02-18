<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Log;
use App\Models\Merito;
use App\Models\User;
use App\Models\Llamado;
use App\Models\Postulacion;
use Carbon\Carbon;
use Dotenv\Exception\ValidationException;
use Illuminate\Http\Request;


use Illuminate\Support\Facades\Storage;

class PostulacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //return view("Postulaciones.create_postulacion");
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
                'usuario_id' => 'required|exists:users,id|unique:postulaciones,usuario_id,null,null,llamado_id,' . $request->input('llamado_id'),
                'curriculum_vitae' => 'required|mimes:pdf|max:2048',

            ],
            [
                'llamado_id.required' => 'El id del llamado es obligatorio.',
                'llamado_id.exists' => 'El llamado no existe.',
                'usuario_id.required' => 'El id del usuario es obligatorio.',
                'usuario_id.exists' => 'El usuario no existe.',
                'usuario_id.unique' => 'Ya se ha postulado a este llamado',
                'curriculum_vitae.required' => 'El cirruculum es obligatorio',
                'curriculum_vitae.mimes' => 'Solo se aceptan pdf.',
            ]);
            
            // GUARDAR EN STORAGE            
            $archivoPDF = $request->file('curriculum_vitae');
            // Guardar el archivo PDF en el sistema de archivos
            $rutaArchivoPDF = $archivoPDF->store('pdfs');



            $llamado = Llamado::findOrFail($request->llamado_id);
            $hoy = Carbon::now();

            if($hoy > $llamado->fecha_cierre){
                $response = response()->json(['data' => null, 'message' => ['Este llamado ya se encuentra cerrado'], 'status'=> 422 , 'success'=>false]);
                return redirect()->back()->with('response',$response);
            }

            
            $postulacion = Postulacion::create([
                'llamado_id' => $request->llamado_id,
                'usuario_id' => $request->usuario_id,
                'curriculum_vitae' => $rutaArchivoPDF,
            ]);
            
            //Opcion 1
            //Data como null xq no puede serializar el PDF
            $response = response()->json(['data' => null, 'message' => ['Usted se ha postulado exitosamente'], 'status'=> 201, 'success'=>true]);
            return redirect()->back()->with('response',$response);
            
            //Opcion 2
            // return redirect()->route('postulaciones.index')->with('success', 'Usted se a postulado exitosamente');
            
            
        }catch(\Illuminate\Validation\ValidationException $e){
            $errores = $e->errors();
            $response = response()->json(['data' => null, 'message' => $errores, 'status'=> 422, 'success'=>false]);
            return redirect()->back()->with('response', $response);

        }
        catch(\Exception $e){
            
            $response = response()->json(['data' => null, 'message' => $e->getMessage(), 'status'=> 501, 'success'=>false]);
            return redirect()->back()->with('response', $response);
            // return redirect()->back()->with('error', $e->getMessage());
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
    public function destroy(String $postulacionId)
    {
        try{
            // echo $postulacionId;
            Postulacion::findOrFail($postulacionId)->delete();
        
            $response = response()->json(['data' => null, 'message' => ['Postulación cancelada'], 'status'=> 204, 'success'=>true]);
            return redirect()->back()->with('response',$response);
            
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al cancelar la postulación: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response',$response);
        }
    }

    public function descargarCurriculum($postulacionId)
    {
        try{
            // Obtén la postulación y el usuario asociado
            $postulacion = Postulacion::findOrFail($postulacionId);
            $user = User::findOrFail($postulacion->usuario_id);
            
            // Verifica si el curriculum está almacenado en la base de datos
            if ($postulacion->curriculum_vitae) {
                // Obtén el contenido del PDF desde el BLOB
                $rutaPdf = $postulacion->curriculum_vitae;

                $nombrePDF = $user->name . $user->last_name . '.pdf';
                if(!Storage::exists($rutaPdf)){
                    abort(404, 'El curriculum no pudo ser encontrado.');
                }

                return Storage::download($rutaPdf,$nombrePDF);
            } else {
                // Maneja la situación en la que el curriculum no existe en la base de datos
                abort(404, 'El curriculum no pudo ser encontrado.');
            }
        }catch(\Exception $e){
            echo $e->getMessage();
        }
    }

    public function calificar_postulacion(Postulacion $postulacion){
        try{
            $meritos = Merito::all();
            return view('Postulaciones.calificar_postulacion')->with(compact('postulacion','meritos'));
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al calificar la postulación: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response',$response);
            
        }
    }

    public function asignar_puntajes(Request $request,Postulacion $postulacion)
    {
        try{


            $request->validate([
                  'meritos' => 'required|array',
                  'meritos.*' => 'required|integer|between:1,10',
              ],
             [
                 'meritos.required' => 'Debe puntuar los mértios.',
                 'meritos.*.between' => 'El puntaje del debe ser entre :min y :max.',
                 'meritos.*.integer' => 'El puntaje debe ser un número entero.',
                 'meritos.*.required' => 'Debe puntuar todos los méritos .',
             ]);
            //Procesa y guarda los puntajes ingresados para cada mérito
            foreach ($request->meritos as $meritoId => $puntaje) {
                $postulacion->meritos()->syncWithoutDetaching([$meritoId => ['puntaje' => $puntaje]]);
            }

            $response = response()->json(['data' => null, 'message' => ['Calificación hecha correctamente'], 'status'=> 201, 'success'=>true]);
            return redirect()->back()->with('response',$response);
        }catch(\Illuminate\Validation\ValidationException $e){
            $errores=[];
            //  foreach( ['hola'=>'a'] as $nombre => $cont){
            //      array_push($errores, $cont);

            //     }
            
            $errorsValidaro = $e->validator->errors()->all();
            // foreach($errorsValidaro as $nombreError => $error){
            //     foreach($error as $e){
            //         array_push($errores, $e);
            //     }
            // }
            $response = response()->json(['data' => null, 'message' => $errorsValidaro, 'status'=> 422, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
        catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => $e->getMessage(), 'status'=> 501, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
    }
    public function editar_calificar_postulacion(Postulacion $postulacion)
    {
        try{
            $meritos = Merito::all();
            return view('Postulaciones.calificar_postulacion')->with(compact('postulacion','meritos'));   
        }catch(\Exception $e){   
            $response = response()->json(['data' => null, 'message' => $e->getMessage(), 'status'=> 501, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
    }

    public function generar_orden_de_merito(String $idPostulacion){
        try{
            $postulacion = Postulacion::findOrFail($idPostulacion);
            return view('Postulaciones.generar_orden_de_merito')->with(compact('postulacion'));
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al generar órden de mérito: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response',$response);
        }
    }
}
