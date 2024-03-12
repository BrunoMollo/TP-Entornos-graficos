<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llamado;
use Illuminate\Support\Facades\Auth;
use Mail;
use App\Mail\PrimerPuesto;
use Carbon\Carbon;


class JefeCatedraController extends Controller
{
    public function vacantes_mi_catedra()
    {
        $catedrasUsuario = Auth::user()->catedras;
        $catedraIds = $catedrasUsuario->pluck('id');

        $hoy = Carbon::now()->toDateString();

        // Obtener las entradas donde fecha_cierre > hoy y ordenarlas por fecha_cierre
        $llamadosFechaHoy = Llamado::whereIn('catedra_id', $catedraIds)->where('fecha_cierre', '>', $hoy)
                                    ->orderBy('fecha_cierre')
                                    ->get();

        // Obtener todas las demás entradas y ordenarlas por fecha_cierre
        $llamadosOtrasFechas = Llamado::whereIn('catedra_id', $catedraIds)->where('fecha_cierre', '<=', $hoy)
                                    ->orderByDesc('fecha_cierre')
                                    ->get();

        // Unir ambos resultados
        $llamados = $llamadosFechaHoy->concat($llamadosOtrasFechas);

        
        // $llam = Llamado::whereIn('catedra_id', $catedraIds)->get();
        // $llamados = $llam->sortBy('fecha_cierre');

        return view('Vacantes.vacantes_mi_catedra', ['llamados' => $llamados]);
    }

    public function postulaciones(Llamado $llamado)
    {
        $postulaciones = $llamado->postulaciones->load('user');
        return view('Postulaciones.index', compact('postulaciones', 'llamado'));
    }

    public function primer_puesto(String $dest, Llamado $llamado,Request $request){
        
        try{
            // Validar los datos del formulario si es necesario
            $request->validate([
                'contenido' => 'required|string',
            ],[
                'contenido.required' => 'Debe ingresar un cuerpo de mail'
            ]);
    
            // Obtener el contenido del formulario
            $contenido = $request->input('contenido');
    
            $llam= Llamado::find($llamado)->first();
            Mail::to($dest)->send(new PrimerPuesto($llam,$contenido));

            $response = response()->json(['data' => null, 'message' => ['Email enviado'], 'status'=> 200, 'success'=>true]);
            return redirect()->back()->with('response', $response);
        }catch(ValidationException $e){
            
            $response = response()->json(['data' => null, 'message' => $e->errors(), 'status'=> 402, 'success'=>false]);
            //return redirect('/users/create')->with('response', $response);
            //NO LO HAGO CON SWEET ALTER PERO SE PORRIA CAMBIAR

            return redirect()->back()->withErrors($e->validator)->withInput();
            
        }catch(\Exception $e){
            $response = response()->json(['data' => null, 'message' => ['Error interno al crear el usuario, ' . $e->getMessage()], 'status'=> 500, 'success'=>false]);
            return redirect()->back()->with('response', $response);
            
        }
    }
}

    
