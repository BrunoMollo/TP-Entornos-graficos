<?php

namespace Database\Seeders;

use App\Models\Merito;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MeritosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $merito = Merito::create([
            'nombre' => 'Titulo universitario',
        ]);
        $merito = Merito::create([
            'nombre' => 'Titulo vinculado a la asignatura',
        ]);
        $merito = Merito::create([
            'nombre' => 'Antecedentes docentes',
        ]);
        $merito = Merito::create([
            'nombre' => 'Antecedentes laborales afines a la asignatura',
        ]);
        $merito = Merito::create([
            'nombre' => 'Obras y publicaciones',
        ]);
        $merito = Merito::create([
            'nombre' => 'Concurrencia a congresos',
        ]);
    }
}





	
	
