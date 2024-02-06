<?php

namespace Database\Seeders;

use App\Models\Catedra;
use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class CatedraSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Entornos Graficos
        $user = User::create([
            'name' => 'Daniela',
            'last_name' => "Diaz",
            'email' => 'dd@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::where('name', 'jefe_catedra')->first();
        $user->assignRole($role);
        Catedra::create([
            "nombre" => "Entornos Graficos",
            "jefe_catedra_id" => $user->id
        ]);


        // Gestion de datos
        $user = User::create([
            'name' => 'Adrian',
            'last_name' => "Meca",
            'email' => 'am@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::where('name', 'jefe_catedra')->first();
        $user->assignRole($role);
        Catedra::create([
            "nombre" => "Gestion de datos",
            "jefe_catedra_id" => $user->id
        ]);

        // Algebra y geometria analitica
        $user = User::create([
            'name' => 'Pablo',
            'last_name' => "Sabatineli",
            'email' => 'ps@gmail.com',
            'password' => bcrypt('12345678'),
        ]);
        $role = Role::where('name', 'jefe_catedra')->first();
        $user->assignRole($role);
        Catedra::create([
            "nombre" => "Algebra y geometria analitica",
            "jefe_catedra_id" => $user->id
        ]);
    }
}
