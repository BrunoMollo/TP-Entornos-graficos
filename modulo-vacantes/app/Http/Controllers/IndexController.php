<?php

namespace App\Http\Controllers;

use App\Models\Llamado;
use Carbon\Carbon;
use Illuminate\Http\Request;

class IndexController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $hoy = Carbon::now();
        $llam = Llamado::where('fecha_cierre' ,'>', $hoy)->get();
        // });

        // Ordenar la colección según la fecha de cierre
        $llamados = $llam->sortBy('fecha_cierre');

        return view('Index.index')->with(compact('llamados'));
    }
}
