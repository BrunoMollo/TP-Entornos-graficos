<?php

namespace App\Http\Controllers;

use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use App\Models\Llamado;
use App\Models\Catedra;
use Carbon\Carbon;
use Illuminate\Validation\ValidationException;

class AdminLlamadosController extends Controller
{
    public function admin_llamados()
    {
        $llamados = Llamado::with('catedra')->get();
        return view('Llamados.index', ['llamados' => $llamados]);
    }

    public function vacantes_cerradas()
    {
        
        $hoy = Carbon::now();
        $llamados = Llamado::where('fecha_cierre' ,'<', $hoy)->get();
        return view('Vacantes.vacantes_cerradas', ['llamados' => $llamados]);
    }

    public function create()
    {
        $catedras = Catedra::all();

        return view('Llamados.create_llamado', ['catedras' => $catedras]);
    }

    public function store(Request $request)
    {
        try{
            // Validación de los campos del formulario
            $request->validate([
                'catedra_id' => 'required|exists:catedras,id',
                'puesto' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_cierre' => 'required|date',
            ]);
    
            if($request->fecha_cierre < Carbon::now()){
                throw new \Exception('La fecha de cierre no puede ser menor a la de hoy');
            }
        
            // Crear un nuevo llamado en la base de datos
            $llamado = Llamado::create([
                'catedra_id' => $request->input('catedra_id'),
                'puesto' => $request->input('puesto'),
                'descripcion' => $request->input('descripcion'),
                'fecha_apertura' => Carbon::now(),
                'fecha_cierre' => $request->input('fecha_cierre'),
            ]);
            
            // return redirect()->route('admin_llamados')->with('success', 'Llamado creado exitosamente');
            $response = response()->json( ['data' => $llamado, 'message' => ['Llamado creado exitosamente'], 'status'=> 201, 'success'=>true] );
    
            // Redirigir a la vista /users/create
            return redirect()->back()->with('response', $response);

        }catch(ValidationException $e){
            $errorsValidacion = $e->validator->errors()->all();
            $response = response()->json(['data' => null, 'message' => $errorsValidacion, 'status'=> 422, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
        catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => $e->getMessage(), 'status'=> 501, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
    }

    public function edit($id)
    {
        $llamado = Llamado::findOrFail($id);
        $catedras = Catedra::all();

        return view('Llamados.edit_llamado', compact('llamado', 'catedras'));
    }

    public function update(Request $request, $id)
    {
        
        try{
            $request->validate([
                'catedra_id' => 'required|exists:catedras,id',
                'puesto' => 'required|string|max:255',
                'descripcion' => 'required|string',
                'fecha_cierre' => 'required|date',
            ]);
        
            $llamado = Llamado::findOrFail($id);
        
            if($request->fecha_cierre < Carbon::now()){
                throw new \Exception('La fecha de cierre no puede ser menor a la de hoy');
            }
        
            $llamado->update([
                'catedra_id' => $request->input('catedra_id'),
                'puesto' => $request->input('puesto'),
                'descripcion' => $request->input('descripcion'),
                'fecha_cierre' => $request->input('fecha_cierre'),
            ]);
        
            // return redirect()->route('admin_llamados')->with('success', 'Llamado actualizado exitosamente');
            $response = response()->json(['data' => $llamado, 'message' => ['Llamado actualizado exitosamente'], 'status'=> 200, 'success'=>true]);
    
            
            return redirect()->back()->with('response', $response);

        }catch(ValidationException $e){
            $errorsValidacion = $e->validator->errors()->all();
            $response = response()->json(['data' => null, 'message' => $errorsValidacion, 'status'=> 422, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
        catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => $e->getMessage(), 'status'=> 501, 'success'=>false]);
            return redirect()->back()->with('response', $response);
        }
    }

    public function destroy($id)
    {
        try{
            $llamado = Llamado::findOrFail($id);
            $llamado->delete();
    
            $response = response()->json(['data' => null, 'message' => ['Llamado eliminado'], 'status'=> 204, 'success'=>true]);
            return redirect()->back()->with('response',$response);
            
        }catch(QueryException $e){
            $response = response()->json(['data' => null, 'message' => ['No puede eliminar este llamado porque hay postulaciónes asociadas a este, debe eliminar las postulaciones también',], 'status'=> 422 , 'success'=>false,'id'=> $id ]);
            return redirect()->back()->with('response',$response);
        }
        catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al eliminar el llamado: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response',$response);
        }
    }

    public function destroyConPostulaciones($id)
    {
        try{
            $llamado = Llamado::findOrFail($id);

            // Eliminar todas las postulaciones asociadas al llamado
            $llamado->postulaciones()->delete();

            // Eliminar el llamado
            $llamado->delete();
    
            $response = response()->json(['data' => null, 'message' => ['Llamado eliminado'], 'status'=> 204, 'success'=>true]);
            return redirect()->back()->with('response',$response);
            
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error al eliminar el llamado: ' . $e->getMessage(),], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response',$response);
        }
    }
}
