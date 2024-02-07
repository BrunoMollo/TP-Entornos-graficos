<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Llamado;
use Illuminate\Support\Facades\Auth;

class JefeCatedraController extends Controller
{
    public function vacantes_mi_catedra()
    {
        $catedrasUsuario = Auth::user()->catedras;
        $catedraIds = $catedrasUsuario->pluck('id');
        $llamados = Llamado::whereIn('catedra_id', $catedraIds)->get();
        return view('Vacantes.vacantes_mi_catedra', ['llamados' => $llamados]);
    }

    public function postulaciones(Llamado $llamado)
    {
        $postulaciones = $llamado->postulaciones->load('user');
        return view('Postulaciones.index', compact('postulaciones', 'llamado'));
    }
}
