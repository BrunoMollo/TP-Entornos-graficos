<?php

namespace Database\Seeders;

use App\Models\Catedra;
use App\Models\Llamado;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class LlamadoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Entornos Graficos
        $llamado = Llamado::create([
            'puesto' => 'Profesor',
            'descripcion' => "Una descripción corta",
            'fecha_apertura' => Carbon::now(),
            'fecha_cierre' => '2023-09-12',
            'catedra_id' => 1,
        ]);

        // Base de Datos
        $llamado = Llamado::create([
            'puesto' => 'Profesor',
            'descripcion' => "Una descripción corta",
            'fecha_apertura' => Carbon::now(),
            'fecha_cierre' => '2024-08-07',
            'catedra_id' => 2,
        ]);
    }
}
