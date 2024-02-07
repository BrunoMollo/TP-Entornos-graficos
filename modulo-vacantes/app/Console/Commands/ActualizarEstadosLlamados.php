<?php

namespace App\Console\Commands;

use App\Mail\AvisoFinInscripcionLlamadoJefeCatedra;
use App\Models\Llamado;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Mail;

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


        //Llamados a actualizar
        $llamados_a_atualizar = Llamado::where('fecha_cierre', '<', now())->get();


        foreach ($llamados_a_atualizar as $llamado) {
            $llamado->update(['estado' => 'cerrado']);

            // Envío de correo electrónico
            $destinatario = $llamado->catedra->jefe_catedra->email; 
            Mail::to($destinatario)->send(new AvisoFinInscripcionLlamadoJefeCatedra($llamado));
        }


    }
}
