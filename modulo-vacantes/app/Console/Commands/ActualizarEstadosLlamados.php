<?php

namespace App\Console\Commands;

use App\Mail\AvisoFinInscripcionLlamadoJefeCatedra;
use App\Models\Llamado;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class ActualizarEstadosLlamados extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:actualizar-estados-llamados';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        //  Llamados a actualizar
        // Obtener la fecha de hoy
        $fechaHoy = Carbon::now()->toDateString();

        // Crear un objeto Carbon para la fecha específica '2024-03-08'
        // $fechaEspecificaTest = Carbon::createFromFormat('Y-m-d', '2024-03-08')->toDateString();

        // Obtener los llamados donde la fecha de cierre sea igual a la fecha de hoy
        $llamados = Llamado::whereDate('fecha_cierre', $fechaHoy)->get();


        foreach ($llamados as $llamado) {

        //   Envío de correo electrónico
            $destinatario = $llamado->catedra->jefe_catedra->email; 
            Mail::to($destinatario)->send(new AvisoFinInscripcionLlamadoJefeCatedra($llamado));
        }

        // $llam= Llamado::find(1)->first();
        // Mail::to('ginogallina2002@gmail.com')->send(new AvisoFinInscripcionLlamadoJefeCatedra($llam));

    }
}
