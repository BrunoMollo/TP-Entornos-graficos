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
        return view('vacantes_mi_catedra', ['llamados' => $llamados]);
    }
}
